<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\MovieList;
use App\Form\MovieListType;
use App\Repository\MovieListRepository;



class UserSpaceController extends AbstractController
{
    /**
     * @Route("/userspace", name="user_space", methods={"GET","POST"})
     */

     function index(Request $request, EntityManagerInterface $em, UserInterface $user,MovieListRepository $movieListRepository ):Response
     {
       $movieList = new MovieList();
       $movieList->setUser($user);
       $form = $this->createForm(MovieListType::class, $movieList);
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($movieList);
           $entityManager->flush();

         //  return $this->redirectToRoute('movie_list_index');
        }
        $id=$user->getId();
        $movieLists= $this->getDoctrine()
        ->getRepository(MovieList::class)
        ->findBy(  ['user' => $id]);
       return $this->render('user_space/index.html.twig', [
           'form' => $form->createView(),
           'movie_lists' => $movieLists
       ]);
     }


}
