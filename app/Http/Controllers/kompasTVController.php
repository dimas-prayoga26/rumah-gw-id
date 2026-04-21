<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\DomCrawler\Crawler;

class kompasTVController extends Controller
{
    public function index(){
        $client = new Client();
        $berita = [];

        for($page = 1; $page <= 3; $page++){
            $response = $client->request('GET', 'https://properti.kompas.com/tips-properti/' . $page);
            $html = $response->getBody()->getContents();
            $crawler = new Crawler($html);

            $crawler->filter('.articleList .articleItem')->each(function ($node) use (&$berita){
                $title = $node->filter('.articleTitle')->text();
                $link = $node->filter('a')->attr('href');
                $date = $node->filter('.articlePost-date')->text();

                $image = null;
                if($node->filter('img')->count() > 0){
                    $image = $node->filter('img')->attr('src');
                }

                $berita[] = [
                    'date' => $date,
                    'title' => $title,
                    'link' => $link,
                    'image' => $image
                ];
            });
        }

        $collection = collect($berita);

        $perPage = 6;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $currentItems = $collection->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginated = new LengthAwarePaginator(
            $currentItems,
            $collection->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url()]
        );

        return view('pages.news', ['berita' => $paginated]);
    }
}
