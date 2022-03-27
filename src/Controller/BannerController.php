<?php

namespace App\Controller;

use App\Entity\Banner;
use App\Entity\Product;
use App\Form\BannerType;
use App\Repository\BannerRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/banner")
 */
class BannerController extends AbstractController
{
    /**
     * @Route("/", name="banner_index", methods={"GET"})
     */
    public function index(BannerRepository $bannerRepository): Response
    {
        return $this->render('banner/index.html.twig', [
            'banners' => $bannerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="banner_new", methods={"GET"})
     */
    public function new(Request $request, BannerRepository $bannerRepository): Response
    {
        return $this->renderForm('banner/new.html.twig', [
            'action' => 'insert',
        ]);

    }

    /**
     * @Route("/{id}", name="banner_show", methods={"GET"})
     */
    public function show(Banner $banner): Response
    {
        return $this->render('banner/show.html.twig', [
            'banner' => $banner,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="banner_edit", methods={"GET"})
     */
    public function edit(Request $request, int $id, BannerRepository $bannerRepository): Response
    {
        $banner = $bannerRepository->find($id);

        return $this->renderForm('banner/edit.html.twig', [
            'banner' => $banner,
            'action' => 'update',
        ]);
    }
    /**
     * @Route("/{id}/update", name="banner_update", methods={"POST"})
     */
    public function update(Request $request, int $id, EntityManagerInterface $entityManager, BannerRepository $bannerRepository): Response
    {
        if ($id == 0) {
            $banner = new Banner();
        } else {
            $banner = $bannerRepository->find($id);
        }

        $action = $request->request->get('action');
        $banner->setTitle($request->request->get('title'));
        $banner->setSubtitle($request->request->get('subtitle'));
        $banner->setBackgroundImage($request->request->get('background_image'));
        $banner->setFrontImage($request->request->get('front_image'));

        $entityManager->persist($banner);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        if ($action=='insert'){
            $this->addFlash('success', 'Banner creado correctamente');
        }else{
            $this->addFlash('success', 'Banner actualizado correctamente');
        }

        //$this->addFlash('error', ' Error al actualizar el Usuario');
        return $this->redirectToRoute('banner_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}", name="banner_delete", methods={"POST"})
     */
    public function delete(Request $request, Banner $banner, BannerRepository $bannerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$banner->getId(), $request->request->get('_token'))) {
            $bannerRepository->remove($banner);
        }

        return $this->redirectToRoute('banner_index', [], Response::HTTP_SEE_OTHER);
    }
}
