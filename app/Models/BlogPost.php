<?php

// app/Models/BlogPost.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $table='blog_posts';
    protected $fillable = ['user_id','title', 'description', 'content', 'category_id'];
}

