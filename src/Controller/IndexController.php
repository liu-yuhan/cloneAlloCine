<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Message\Request;
use Tmdb\SymfonyBundle;

class IndexController extends AbstractController
{

    public function topRated()
    {
      $client = new \GuzzleHttp\Client();
      $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/top_rated?api_key='.ApiController::getkey().'&language=en-US&page=1');
      $topRated=$response->getbody();
      $topRated=json_decode($topRated,true);
      $top3[0]=$topRated['results'][0];
      $top3[1]=$topRated['results'][1];
      $top3[2]=$topRated['results'][2];
     return $top3;
    }


    public function rightSideBar()
    {
      $client = new \GuzzleHttp\Client();
      $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/popular?api_key='.ApiController::getkey().'&language=en-US&page=1');
      $popular=$response->getbody();
      $popular=json_decode($popular,true);
          for ($i=0; $i <15 ; $i++) {
            $pop15[$i]=$popular['results'][$i];
          }
      return $pop15;
    }

    /**
     * @Route("/index", name="home")
     */
    public function returnIndex(){
        $top3=$this->toprated();
        $popular=$this->rightSideBar();
        return $this->render('index/index.html.twig',["tops"=>$top3,"populars"=>$popular]);
      }


}
