<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository): Response
    {
        //var_dump($productRepository->findAll()); die;
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="product_new", methods={"GET"})
     */
    public function new(Request $request, CategoryRepository $categoryRepository): Response
    {
        return $this->renderForm('product/new.html.twig', [
            'action' => 'insert',
            'categorias' => $categoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_show", methods={"GET"})
     */
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_edit", methods={"GET"})
     */
    public function edit(Request $request, int $id, ProductRepository $productRepository, CategoryRepository $categoryRepository): Response
    {
        $product = $productRepository->find($id);

        return $this->renderForm('product/edit.html.twig', [
            'product' => $product,
            'categorias' => $categoryRepository->findAll(),
            'action' => 'update',
        ]);
    }

    /**
     * @Route("/{id}/update", name="product_update", methods={"POST"})
     */
    public function update(Request $request, int $id, EntityManagerInterface $entityManager, ProductRepository $productRepository, CategoryRepository $categoryRepository): Response
    {
        if ($id == 0) {
            $product = new Product();
        } else {
            $product = $productRepository->find($id);
        }
        $idCategory = $request->request->get('category_id');
        $category = $categoryRepository->find($idCategory);
        $action = $request->request->get('action');
        $product->setTitle($request->request->get('title'));
        $product->setMetaTitle($request->request->get('meta_title'));
        $product->setSlug($request->request->get('slug'));
        $product->setCategory($category);
        $product->setMetaDescription($request->request->get('meta_description'));
        $product->setDescription($request->request->get('description'));
        $product->setImage1($request->request->get('image_1'));
        $product->setImage2($request->request->get('image_2'));
        $product->setImage3($request->request->get('image_3'));

        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        if ($action=='insert'){
            $this->addFlash('success', 'Producto creado correctamente');
        }else{
            $this->addFlash('success', 'Producto actualizado correctamente');
        }

        //$this->addFlash('error', ' Error al actualizar el Usuario');
        return $this->redirectToRoute('product_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/{id}", name="product_delete", methods={"POST"})
     */
    public function delete(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_index', [], Response::HTTP_SEE_OTHER);
    }




}
