<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Track;
use Illuminate\Http\Request;

class TracksController extends Controller
{
    public function index(Request $request)
    {
        $query = Track::leftJoin('users as u', 'u.idu', '=', 'tracks.uid');
        $subquery = '';

        if ($request->has('popular'))
            $subquery = "SELECT v.track, COUNT(v.track) as count FROM views as v
                INNER JOIN tracks as t on t.id = v.track
                WHERE DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= date(v.time) AND t.public = 1
                GROUP BY track ORDER BY count DESC LIMIT %s";

        if ($request->has('liked'))
            $subquery = "SELECT l.track, COUNT(l.track) as count FROM likes as l
                 INNER JOIN tracks as t on t.id = l.track
                 WHERE DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= date(l.time) AND t.public = 1
                 GROUP BY track ORDER BY count DESC LIMIT %s";

        if ($request->has('popular') || $request->has('liked')) {
            $perPage = 50;
            $subquery = sprintf($subquery, $perPage);

            return $query->leftjoin(DB::raw("($subquery) as c"), 'c.track', '=', 'tracks.id')
                ->orderBy('c.count', 'desc')
                ->take($perPage)
                ->get();
        }


        return $query->get();
    }
}

// //POPULARES

// "SELECT *, 1 as `top`
// FROM `tracks` as t1
// LEFT JOIN `users` as t2 ON t1.uid  = t2.idu
// LEFT JOIN (
//     SELECT `views`.`track`, COUNT(`track`) as `count`
//     FROM `views`,`tracks`
//     WHERE `views`.`track` = `tracks`.`id`
//         AND DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= date(`views`.`time`)
//         AND `tracks`.`public` = '1'
//         GROUP BY `track`
//         ORDER BY `count`
//         DESC LIMIT %s
// ) as t3 ON t3.track = t1.id
// ORDER BY t3.count
// DESC LIMIT %s"

// // LIKED

// "SELECT *, 1 as `top`
// FROM `tracks` as t1
// LEFT JOIN `users` as t2 ON t1.uid  = t2.idu
// LEFT JOIN (
//     SELECT `likes`.`track`, COUNT(`track`) as `count`
//     FROM `likes`,`tracks`
//     WHERE `likes`.`track` = `tracks`.`id`
//         AND DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= date(`likes`.`time`)
//         AND `tracks`.`public` = '1'
//     GROUP BY `track`
//     ORDER BY `count`
//     DESC LIMIT %s
// ) as t3 ON t3.track = t1.id
// ORDER BY t3.count
// DESC LIMIT %s"

// // TEXTO

// "SELECT *
// FROM `tracks`, `users`
// WHERE `tracks`.`tag` REGEXP '[[:<:]]%s[[:>:]]'
//     AND `tracks`.`uid` = `users`.`idu` %s
//     AND `tracks`.`public` = '1'
//     AND `users`.`private` = 0
// ORDER BY `tracks`.`id`
// DESC LIMIT %s", $this->db->real_escape_string($value), $start, ($this->per_page + 1));


// // SIN TEXTO
// "SELECT *
// FROM `tracks`, `users`
// WHERE `tracks`.`uid` = `users`.`idu` %s
//     AND `tracks`.`public` = 1
//     AND `users`.`private` = 0
// ORDER BY `tracks`.`id`
// DESC LIMIT %s", $start, ($this->per_page + 1));
