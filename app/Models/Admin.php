<?php

namespace App\Models;

class Admin extends Model
{

 protected $table = "admin";

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'id',
    'track',
    'by',
    'time',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [];
}
