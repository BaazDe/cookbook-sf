<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Recipe;
use App\Form\BookType;
use App\Repository\BookRepository;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/book")
 */
class BookController extends AbstractController
{
    /**
     * @Route("/", name="book_index", methods={"GET"})
     */
    public function index(BookRepository $bookRepository): Response
    {
        return $this->render('book/index.html.twig', [
            'books' => $bookRepository->findBy(['user'=>$this->getUser()]),
        ]);
    }

    /**
     * @Route("/new", name="book_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book,
            [
                'action' => $this->generateUrl('book_new'),
                'method' => 'POST',
            ]);
        $form->handleRequest($request);
        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {


            $image =$form['image']->getData();

            if ($image) {
                $imageName = md5(uniqid()). '.'.$image->guessExtension();
                // Move the file to the directory where brochures are stored
                $image->move($this->getParameter('upload_directory_book'), $imageName);

            } else {
                $imageName = "transparent.png";
            }

            $entityManager = $this->getDoctrine()->getManager();
            $book->setImage($imageName);
            $book->setUser($user);

            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('book_index');
        }

        return $this->render('book/new.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="book_show", methods={"GET"})
     */
    public function show(Book $book): Response
    {
        return $this->render('book/show.html.twig', [
            'book' => $book,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="book_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Book $book): Response
    {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('book_index');
        }

        return $this->render('book/edit.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="book_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Book $book): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($book);
            $entityManager->flush();
        }

        return $this->redirectToRoute('book_index');
    }

    /**
     * @param RecipeRepository $repository
     * @param Book $book
     * @param Request $request
     * @param Recipe $recipe
     * @return Response
     * @Route("/{id}/recipes", name="book_recipes")
     */
    public function recipesFromBook(RecipeRepository $repository, Book $book, Request $request): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(Recipe::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image =$form['mainImage']->getData();

            if ($image) {
                $imageName = md5(uniqid()). '.'.$image->guessExtension();
                // Move the file to the directory where brochures are stored
                $image->move($this->getParameter('upload_directory_book'), $imageName);

            } else {
                $imageName = "transparent.png";
            }

            $entityManager = $this->getDoctrine()->getManager();
            $recipe->setMainImage($imageName);

            $entityManager->persist($recipe);
            $entityManager->flush();

            return $this->redirect($request->getRequestUri());
        }

        return $this->render('recipe/recipes.html.twig', [
            'recipes' => $repository->findBy(['book'=> $book]),
            'form' => $form->createView(),
        ]);
    }
}
