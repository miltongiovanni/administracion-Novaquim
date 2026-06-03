<?php

namespace App\Controller;

use App\Entity\Banner;
use App\Entity\Product;
use App\Repository\BannerRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BannerController extends AbstractController
{
    public function __construct(private readonly BannerRepository $bannerRepository, private readonly EntityManagerInterface $entityManager)
    {
    }
    #[Route(path: '/banner/', name: 'banner_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('banner/index.html.twig', [
            'banners' => $this->bannerRepository->findAll(),
        ]);
    }
    #[Route(path: '/banner/new', name: 'banner_new', methods: ['GET'])]
    public function new(): Response
    {
        return $this->render('banner/new.html.twig', [
            'action' => 'insert',
        ]);
    }
    #[Route(path: '/banner/{id}', name: 'banner_show', methods: ['GET'])]
    public function show(Banner $banner): Response
    {
        return $this->render('banner/show.html.twig', [
            'banner' => $banner,
        ]);
    }
    #[Route(path: '/banner/{id}/edit', name: 'banner_edit', methods: ['GET'])]
    public function edit(int $id): Response
    {
        $banner = $this->bannerRepository->find($id);

        return $this->render('banner/edit.html.twig', [
            'banner' => $banner,
            'action' => 'update',
        ]);
    }
    #[Route(path: '/banner/{id}/update', name: 'banner_update', methods: ['POST'])]
    public function update(Request $request, int $id): Response
    {
        $banner = $id === 0 ? new Banner() : $this->bannerRepository->find($id);

        $action = $request->request->get('action');
        $banner->setTitle($request->request->get('title'));
        $banner->setSubtitle($request->request->get('subtitle'));
        $banner->setBackgroundImage($request->request->get('background_image'));
        $banner->setFrontImage($request->request->get('front_image'));

        $this->entityManager->persist($banner);

        // actually executes the queries (i.e. the INSERT query)
        $this->entityManager->flush();

        if ($action=='insert'){
            $this->addFlash('success', 'Banner creado correctamente');
        }else{
            $this->addFlash('success', 'Banner actualizado correctamente');
        }

        //$this->addFlash('error', ' Error al actualizar el Usuario');
        return $this->redirectToRoute('banner_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route(path: '/banner/{id}', name: 'banner_delete', methods: ['POST'])]
    public function delete(Request $request, Banner $banner): Response
    {
        if ($this->isCsrfTokenValid('delete'.$banner->getId(), $request->request->get('_token'))) {
            $this->bannerRepository->remove($banner);
        }

        return $this->redirectToRoute('banner_index', [], Response::HTTP_SEE_OTHER);
    }
}
