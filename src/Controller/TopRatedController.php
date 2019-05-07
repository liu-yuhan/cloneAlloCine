<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Message\Request;
use Tmdb\SymfonyBundle;


class TopRatedController extends AbstractController
{
    /**
     * @Route("/toprated/{page}", name="top_rated")
     */
          public function topRated($page)
          {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/top_rated?api_key='.ApiController::getkey().'&language=en-US&page='.$page);
            $topRated=$response->getbody();
            $topRated=json_decode($topRated,true);
            //var_dump($topRated['results']);
            $page=$topRated['page'];
            return $this->render('top_rated/index.html.twig',["tops"=>$topRated['results'],"page"=>$page]);

          }

}
