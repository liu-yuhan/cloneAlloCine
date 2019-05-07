<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Tmdb\SymfonyBundle;

class SearchController extends AbstractController
{
    private $keyWord;

    public function search_movie_name($apiKey,$keyWord )
    {
      $token  = new \Tmdb\ApiToken($apiKey);
      $client = new \Tmdb\Client($token);
      $result = $client->getSearchApi()->searchMovies($keyWord);
      return $result;
    }

    public function search_star($apiKey,$keyWord)
    {
      $token  = new \Tmdb\ApiToken($apiKey);
      $client = new \Tmdb\Client($token);
      $result = $client->getSearchApi()->searchPersons($keyWord);
      return $result;
    }

    public function search_genre($apikey,$keyWord){
      $id_genre="0";
      if ($keyWord=='Action') {
        $id_genre="28";
      }
      elseif ($keyWord=='Adventure') {
        $id_genre="12";
      }
      elseif ($keyWord=='Animation') {
        $id_genre="16";
      }
      elseif ($keyWord=='Comedy') {
        $id_genre="35";
      }
      elseif ($keyWord=='Crime') {
        $id_genre="80";
      }
      elseif ($keyWord=='Documentary') {
        $id_genre="99";
      }
      elseif ($keyWord=='Drama') {
        $id_genre="18";
      }
      elseif ($keyWord=='Family') {
        $id_genre="10751";
      }
      elseif ($keyWord=='Fantasy') {
        $id_genre="14";
      }
      elseif ($keyWord=='History') {
        $id_genre="36";
      }
      elseif ($keyWord=='Horror') {
        $id_genre='27';
      }
      elseif ($keyWord=='Music') {
        $id_genre='10402';
      }
      elseif ($keyWord=='Mystery') {
        $id_genre='9648';
      }
      elseif ($keyWord=='Romance') {
        $id_genre='10749';
      }
      elseif ($keyWord=='Science Fiction') {
        $id_genre='878';
      }
      elseif ($keyWord=='TV Movie') {
        $id_genre='10770';
      }
      elseif ($keyWord=='Thriller') {
        $id_genre='53';
      }
      elseif ($keyWord=='War') {
        $id_genre='10752';
      }
      elseif ($keyWord=='Western') {
        $id_genre='37';
      }
      $token  = new \Tmdb\ApiToken($apikey);
      $client = new \Tmdb\Client($token);
      $response = $client->getDiscoverApi()->discoverMovies([
          'page' => 1,
          'language' => 'en',
          'with_genres' => $id_genre
      ]);
      return $response;
    }

    public function getKeyWord(){
      return $this->keyWord;
    }


    /**
     * @Route("search", name="search")
     */
    public function search_all()
    {
      if (empty($_POST['search']) ) {
        return $this->redirectToRoute('home');
      }
      $this->keyWord=$_POST['search'];
      $rst['movie_name']=$this->search_movie_name(ApiController::getKey(),$this->keyWord);
      $num_result_title=sizeof( $rst['movie_name']['results']);
      if ($num_result_title<=1) {
        $found_notice_title=$num_result_title.' movie was found with similar title' ;
      }
      else {
          $found_notice_title=$rst['movie_name']['total_results'].' movies were found with similar title' ;
      }
      $rst['movie_genre']=$this->search_genre(ApiController::getKey(),$this->keyWord);
      $num_result_genre=sizeof($rst['movie_genre']['results']);
      if ($num_result_genre==0) {
        $found_notice_genre='sorry, no genre found similar to '.$this->keyWord.'. ' ;
      }
      if ($num_result_genre>0) {
        $found_notice_genre = 'found genre : '. $this->keyWord ;
      }
      return $this->render('search/index.html.twig', ['keyWord'=>($this->keyWord),
      'title_movies'=>$rst['movie_name']["results"],'result_info_title'=>$found_notice_title,
      'found_notice_genre'=>$found_notice_genre ]);
    }
}
