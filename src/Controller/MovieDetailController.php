<?php

namespace App\Controller;

use App\Entity\UserMovieList;
use App\Form\MovieListType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Tmdb\SymfonyBundle;

class MovieDetailController extends AbstractController
{
    /**
     * @Route("/movie/{id}", name="movie_detail")
     */
    public function movie_detail($id,EntityManagerInterface $em )
    {
      $token  = new \Tmdb\ApiToken(ApiController::getkey());
      $client = new \Tmdb\Client($token);
      $movie = $client->getMoviesApi()->getMovie($id);
      return $this->render('movie_detail/index.html.twig',["movie"=>$movie]);
    }
}
