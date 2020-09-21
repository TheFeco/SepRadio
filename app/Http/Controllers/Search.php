<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Track;
use Illuminate\Http\Request;

class Search extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function __invoke(Request $request)
    {
        $q = $request->input('q', '');

        if (!$q) return response(['error' => 'query required'], 400);

        $playlists = Playlist::where('name', 'like', "%$q%")->take(3)->get();
        $tracks = Track::where('title', 'like', "%$q%")->take(3)->get();

        $data = compact('playlists', 'tracks');

        return response(compact('data'));
    }
}
