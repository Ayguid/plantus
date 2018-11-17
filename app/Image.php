<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table='images';

    protected $fillable = ['post_id', 'user_id', 'image_path'];



}
