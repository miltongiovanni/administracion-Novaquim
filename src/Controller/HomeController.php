<?php

namespace App\Controller;

use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/uploadImage", name="uploadImage", methods={"POST"})
     */
    public function uploadImage(Request $request, FileUploader $fileUploader): Response
    {
        $file = $request->files->get('file');
        if ($file) {
            $imageFileName = $fileUploader->upload($file);
        }
        //var_dump($imageFileName);die;
        return $this->json(['location' => $imageFileName]);
    }
}
