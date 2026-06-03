<?php

namespace App\Controller;

use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public function __construct(private readonly FileUploader $fileUploader)
    {
    }
    #[Route(path: '/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route(path: '/uploadImage', name: 'uploadImage', methods: ['POST'])]
    public function uploadImage(Request $request): Response
    {
        $file = $request->files->get('file');
        if ($file) {
            $imageFileName = $this->fileUploader->upload($file);
        }
        //var_dump($imageFileName);die;
        return $this->json(['location' => $imageFileName]);
    }
}
