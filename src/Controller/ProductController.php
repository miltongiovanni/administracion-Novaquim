<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\MercadoRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    public function __construct(private readonly ProductRepository $productRepository, private readonly CategoryRepository $categoryRepository, private readonly MercadoRepository $mercadoRepository, private readonly EntityManagerInterface $entityManager)
    {
    }
    #[Route(path: '/product/', name: 'product_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $this->productRepository->findAll(),
        ]);
    }
    #[Route(path: '/product/new', name: 'product_new', methods: ['GET'])]
    public function new(): Response
    {
        return $this->render('product/new.html.twig', [
            'action' => 'insert',
            'categorias' => $this->categoryRepository->findAll(),
            'mercados' => $this->mercadoRepository->findAll(),
        ]);
    }
    #[Route(path: '/product/{id}', name: 'product_show', methods: ['GET'])]
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }
    #[Route(path: '/product/{id}/edit', name: 'product_edit', methods: ['GET'])]
    public function edit(int $id): Response
    {
        $product = $this->productRepository->find($id);

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'categorias' => $this->categoryRepository->findAll(),
            'mercados' => $this->mercadoRepository->findAll(),
            'action' => 'update',
        ]);
    }
    #[Route(path: '/product/{id}/update', name: 'product_update', methods: ['POST'])]
    public function update(Request $request, int $id): Response
    {
        $product = $id === 0 ? new Product() : $this->productRepository->find($id);
        $idCategory = $request->request->get('category_id');
        $category = $this->categoryRepository->find($idCategory);
        $idMercado = $request->request->get('mercado_id');
        $mercado = $this->mercadoRepository->find($idMercado);
        $action = $request->request->get('action');
        $product->setTitle($request->request->get('title'));
        $product->setMetaTitle($request->request->get('meta_title'));
        $product->setSlug($request->request->get('slug'));
        $product->setCategory($category);
        $product->setMercado($mercado);
        $product->setMetaDescription($request->request->get('meta_description'));
        $product->setDescription($request->request->get('description'));
        $product->setImage1($request->request->get('image_1'));
        $product->setImage2($request->request->get('image_2'));
        $product->setImage3($request->request->get('image_3'));

        $this->entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $this->entityManager->flush();

        if ($action=='insert'){
            $this->addFlash('success', 'Producto creado correctamente');
        }else{
            $this->addFlash('success', 'Producto actualizado correctamente');
        }

        //$this->addFlash('error', ' Error al actualizar el Usuario');
        return $this->redirectToRoute('product_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route(path: '/product/{id}', name: 'product_delete', methods: ['POST'])]
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $this->productRepository->remove($product);
        }

        return $this->redirectToRoute('product_index', [], Response::HTTP_SEE_OTHER);
    }
}
