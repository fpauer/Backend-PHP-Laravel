<?php

namespace PublicNews\Http\Controllers;

use Illuminate\Support\Facades\Crypt;

use \Barryvdh\DomPDF\PDF;

use PublicNews\Http\Requests\ArticleRequest;

use Illuminate\Support\Facades\Auth;
use PublicNews\Http\Middleware\Util;
use PublicNews\Http\Requests;
use Illuminate\Http\Request;
use PublicNews\Articles;

class ArticleController extends Controller
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
    public function index($slug)
    {
    	$article = Articles::where('link','=',$slug)->first();
    	return view('article.index', ['article'=>$article]);
    }
    
    /**
     * create a new article.
     *
     * @return View
     */
    public function create()
    {
    	$article = new Articles();
        return view('article.create', ['article'=>$article]);
    }
    
    /**
     * create a pdf for article.
     *
     * @return PDF
     */
    public function pdf($slug)
    {
    	
    	ini_set('xdebug.max_nesting_level', 200);
    	
    	$article = Articles::where('link','=',$slug)->first();
    	
	    $pdf = \Barryvdh\DomPDF\Facade::loadView('article.pdf', ['article'=>$article] );
	    
	    return $pdf->download('download.pdf');
    }
    
    
    /**
     * save a new article.
     *
     * @return View
     */
    public function store(ArticleRequest $request)
    {
		$input = $request->all();
		
		$article = new Articles();
		$article->user_id = Auth::user()->id;
		$article->title = $input['Title'];
		$article->body = $input['Content'];
		$article->link = Util::to_permalink( $article->title );
		$article->author_name = $input['ReporterName'];
		$article->author_email = $input['ReporterEmail'];
		$article->updated_at = time();
		$article->active = 0;
		
		if( !empty($_FILES["file"]["tmp_name"]) )
		{
			$photo = \Cloudinary\Uploader::upload($_FILES["file"]["tmp_name"]);
			$article->photo_path = $photo['url'];//upload image to cloudnary
		}

		$article->save();
		
		$articles = Articles::where('user_id','=',Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
        return view('home', ['action'=>'success','message'=>'Well done! Your article was created successfully. But it is not visible yet!','articles'=>$articles]);
    }
    
    
    /**
     * delete an article.
     *
     * @return View
     */
    public function destroy($id)
    {
    	$article_id = Crypt::decrypt($id);
    	Articles::where('id', '=', $article_id)->delete();		
    	
    	$articles = Articles::where('user_id','=',Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
        return "OK";
    }
    
    
    /**
     * Update the article.
     *
     * @return View
     */
    public function update(Request $request, $id)
    {
		$input = $request->all();
    	$article_id = Crypt::decrypt($id);
    	$article = Articles::where('id', '=', $article_id)->first();	
    	$article->active = $input['active'];
    	$article->save();
    	return "OK";
    }
}
