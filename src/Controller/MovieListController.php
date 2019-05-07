<?php

namespace App\Controller;

use App\Entity\MovieList;
use App\Form\MovieListType;
use App\Repository\MovieListRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/movielist")
 */
class MovieListController extends AbstractController
{
    /**
     * @Route("/", name="movie_list_index", methods={"GET"})
     */
    public function index(MovieListRepository $movieListRepository): Response
    {
        return $this->render('movie_list/index.html.twig', [
            'movie_lists' => $movieListRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="movie_list_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $movieList = new MovieList();
        $form = $this->createForm(MovieListType::class, $movieList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($movieList);
            $entityManager->flush();

            return $this->redirectToRoute('movie_list_index');
        }

        return $this->render('movie_list/new.html.twig', [
            'movie_list' => $movieList,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="movie_list_show", methods={"GET"})
     */
    public function show(MovieList $movieList): Response
    {
        return $this->render('movie_list/show.html.twig', [
            'movie_list' => $movieList,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="movie_list_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MovieList $movieList): Response
    {
        $form = $this->createForm(MovieListType::class, $movieList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('movie_list_index', [
                'id' => $movieList->getId(),
            ]);
        }

        return $this->render('movie_list/edit.html.twig', [
            'movie_list' => $movieList,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="movie_list_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MovieList $movieList): Response
    {
        if ($this->isCsrfTokenValid('delete'.$movieList->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($movieList);
            $entityManager->flush();
        }

        return $this->redirectToRoute('movie_list_index');
    }
}
