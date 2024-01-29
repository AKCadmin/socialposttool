<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialPostModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_post';
    protected $primaryKey = 'id';
    public $timestamps = false; // Assuming you don't want the default created_at and updated_at columns

    protected $fillable = [
        'post_id',
        'short_url_id',
        'social_media_id',
        'post_content_text',
        'is_media_post',
        'post_url',
        'created_on',
        'created_by',
    ];
}