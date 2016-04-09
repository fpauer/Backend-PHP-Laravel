<?php // app/database/seeds/ArticleTableSeeder.php

use App\Article;

class ArticleTableSeeder extends Seeder {

    public function run()
    {
        DB::table('article')->delete();
    
        Article::create(array(
            'author' => 'Chris Sevilleja',
            'text' => 'Look I am a test comment.'
        ));
    
        Article::create(array(
            'author' => 'Nick Cerminara',
            'text' => 'This is going to be super crazy.'
        ));
    
        Article::create(array(
            'author' => 'Holly Lloyd',
            'text' => 'I am a master of Laravel and Angular.'
        ));
    }    

}
