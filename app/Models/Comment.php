<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Comment extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'id',
    'uid',
    'tid',
    'message',
    'time',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [];
}
