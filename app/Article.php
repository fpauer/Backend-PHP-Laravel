<?php

namespace MyNews;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'article';
    
    protected $fillable = ['user_id', 'title', 'body', 'photo_path', 'link', 'author_name', 'author_email', 'updated_at', 'active'];
    
    protected $visible = ['id_crypt', 'user_id', 'title', 'body', 'photo_path', 'link', 'author_name', 'author_email', 'created_at', 'updated_at', 'active'];
    
}
