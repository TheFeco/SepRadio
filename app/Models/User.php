<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idu',
        'username',
        'password',
        'email',
        'first_name',
        'last_name',
        'country',
        'city',
        'website',
        'description',
        'date',
        'facebook',
        'twitter',
        'gplus',
        'youtube',
        'vimeo',
        'tumblr',
        'soundcloud',
        'myspace',
        'lastfm',
        'image',
        'private',
        'suspended',
        'salted',
        'login_token',
        'cover',
        'gender',
        'online',
        'offline',
        'ip',
        'notificationl',
        'notificationc',
        'notificationd',
        'notificationf',
        'email_comment',
        'email_like',
        'email_new_friend',
        'email_newsletter',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
