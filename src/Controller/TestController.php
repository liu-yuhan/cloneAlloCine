<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
//use GuzzleHttp\Message\Response;
use GuzzleHttp\Message\Request;
//use Symfony\Component\Panther\Client;
class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */

     function test(){
     $client = new \GuzzleHttp\Client();
// Create a GET request using Relative to base URL
// URL of the request: http://baseurl.com/api/v1/path?query=123&value=abc)
//   $request= $client->get('550?api_key=3977eef8d945cc2f6346cc5b7e6d582e');
     $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/550?api_key=3977eef8d945cc2f6346cc5b7e6d582e');
     //echo $response->getStatusCode(); # 200
     //echo $response->getHeaderLine('content-type'); # 'application/json; charset=utf8'
     $tests=$response->getBody(); # '{"id": 1420053, "name": "guzzle", ...}'
    //return $this->json(array($test));
    $rst = json_decode($tests, true);
    var_dump($rst);
    echo "</br>";
    echo "</br>";
    echo "</br>";
    echo "</br>";
    echo "</br>";
//  var_dump($rst['genres'][0]['name']);
  //$rtn['genre']=$rst['genres'][0]['name'];
  //$rtn['title']=$rst['title'];
    return $this->render('test/index.html.twig',["tests"=>$rst]);

     }
     // Create HEAD request using a relative URL with an absolute path
     // URL of the request: http://baseurl.com/path?query=123&value=abc

}
