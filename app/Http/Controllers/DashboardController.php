<?php

namespace MyNews\Http\Controllers;

use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Crypt;

use MyNews\Http\Requests\ArticleRequest;
use MyNews\Http\Requests;
use Illuminate\Http\Request;
use MyNews\Article;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the article.
     *
     * @return View
     */
    public function page()
    {
    	return view('home',[]);
    }
    
    /**
     * Encrypt the field id for a collection or a single Model
     * 
     * @param unknown_type $articles
     */
    private function transform($articles)
    {
    	if( is_a($articles, "Illuminate\Database\Eloquent\Collection") )
    	{
	    	$articles->transform(function ($item) {
	    		$item['id_crypt'] = Crypt::encrypt($item->id);
	    		return $item;
	    	});
    	}
    	else
    	{
	    	$articles['id_crypt'] = Crypt::encrypt($articles->id);
    	}
    	return $articles;
    }
    
    /**
    * Return the user articles.
    *
    * @return JSON ARRAY
    */
    public function readAll()
    {
    	$articles = Article::where('user_id', '=', Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
    	
    	$this->transform($articles);
    	
    	return response()->json($articles, 200);
    }
    
    
    /**
     * Show the article.
     *
     * @return JSON
     */
    public function index($slug)
    {
    	$article = Article::where('link','=',$slug)->first();
    	$this->transform($article);
    	return response()->json($article);
    }
    
    /**
     * save a new article.
     *
     * @return JSON ARRAY
     */
    public function store(ArticleRequest $request)
    {
    	$input = $request->all();
    
    	$article = new Article();
    	$article->user_id = Auth::user()->id;
    	$article->title = $input['Title'];
    	$article->body = $input['Content'];
    	$article->link = Util::to_permalink( $article->title );
    	$article->author_name = $input['ReporterName'];
    	$article->author_email = $input['ReporterEmail'];
    	$article->updated_at = time();
    	$article->active = 0;
    
    	//if( !empty($_FILES["file"]["tmp_name"]) )
    	//{
    	//	$photo = \Cloudinary\Uploader::upload($_FILES["file"]["tmp_name"]);
    	//	$article->photo_path = $photo['url'];//upload image to cloudnary
    	//}
    
    	$article->save();
    
    	$articles = Article::where('user_id','=',Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
    	$this->transform($articles);
    	return response()->json($articles);
    }
    
    /**
     * Update the article.
     *
     * @return View
     */
    public function update(ArticleRequest $request, $id)
    {
    	$input = $request->all();
    	$article_id = Crypt::decrypt($id);
    	$article = Article::where('id', '=', $article_id)->first();
    	$article->active = $input['active'];
    	$article->save();
    	return response()->json(['status' => 'OK'], 200);
    }
    
    /**
     * delete an article.
     *
     * @return View
     */
    public function destroy($id)
    {
    	$article_id = Crypt::decrypt($id);
    	Article::where('id', '=', $article_id)->delete();
    	 
    	$articles = Article::where('user_id','=',Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
    	return response()->json(['status' => $id], 200);
    }
    
}
