<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    public function __construct(private readonly CategoryRepository $categoryRepository, private readonly EntityManagerInterface $entityManager)
    {
    }
    #[Route(path: '/category/', name: 'category_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $this->categoryRepository->findAll(),
        ]);
    }
    #[Route(path: '/category/new', name: 'category_new', methods: ['GET'])]
    public function new(): Response
    {
        return $this->render('category/new.html.twig', [
            'action' => 'insert',
        ]);
    }
    #[Route(path: '/category/{id}', name: 'category_show', methods: ['GET'])]
    public function show(Category $category): Response
    {
        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }
    #[Route(path: '/category/{id}/edit', name: 'category_edit', methods: ['GET'])]
    public function edit(int $id): Response
    {
        $category = $this->categoryRepository->find($id);

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'action' => 'update',
        ]);
    }
    #[Route(path: '/category/{id}/update', name: 'category_update', methods: ['POST'])]
    public function update(Request $request, int $id): Response
    {
        $category = $id === 0 ? new Category() : $this->categoryRepository->find($id);
        $action = $request->request->get('action');
        $category->setName($request->request->get('name'));
        $category->setSlug($request->request->get('slug'));

        $this->entityManager->persist($category);

        // actually executes the queries (i.e. the INSERT query)
        $this->entityManager->flush();

        if ($action=='insert'){
            $this->addFlash('success', 'Categoría creada correctamente');
        }else{
            $this->addFlash('success', 'Categoría actualizada correctamente');
        }

        //$this->addFlash('error', ' Error al actualizar el Usuario');
        return $this->redirectToRoute('category_index', [], Response::HTTP_SEE_OTHER);

    }
    #[Route(path: '/category/{id}', name: 'category_delete', methods: ['POST'])]
    public function delete(Request $request, Category $category): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $this->categoryRepository->remove($category);
        }

        return $this->redirectToRoute('category_index', [], Response::HTTP_SEE_OTHER);
    }
}
