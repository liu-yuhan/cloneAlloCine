<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Tmdb\SymfonyBundle;

class DiscoverController extends AbstractController
{
    /**
     * @Route("/discover", name="discover")
     */

    public function discover()
    {   
    $token  = new \Tmdb\ApiToken(ApiController::getkey());
    $client = new \Tmdb\Client($token);
    
    $response = $client->getDiscoverApi()->discoverMovies([
        'page' => 1,
        'language' => 'en'

    ]);
    return $this->render('discover/index.html.twig',["discover"=>$response['results']]);
  
    }

}