<?php

namespace App\Http\Controllers;

use App\Api\TmdbApi;
use App\Services\Pager;
use Illuminate\View\View;

class MovieController extends Controller
{
    public function __construct(private TmdbApi $tmdbApi, private Pager $pager)
    {
    }


    public function index(int $page = 1): View
    {
        $movieList = $this->tmdbApi->getTrending($page);

        //api page >500: Invalid page: Pages start at 1 and max at 500. They are expected to be an integer.
        $maxPage = min([500,$movieList->totalPages]);

        return view('movie/index', [
            'movieList' => $movieList,
            'pages' => $this->pager->getPages($page, $maxPage),
            'maxPage' => $maxPage
        ]);
    }

    public function show(int $id): View
    {
        return view('movie/show', [
            'movie' => $this->tmdbApi->getMovie($id)
        ]);
    }


}
