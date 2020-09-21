<?php

namespace App\Models;

class Track extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'id',
    'uid',
    'title',
    'description',
    'name',
    'tag',
    'art',
    'buy',
    'record',
    'release',
    'license',
    'size',
    'as3_track',
    'download',
    'time',
    'public',
    'likes',
    'downloads',
    'views',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [];
}
