<?php

namespace App\Controller;

use App\Entity\Mercado;
use App\Repository\MercadoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MercadoController extends AbstractController
{
    public function __construct(private readonly MercadoRepository $mercadoRepository, private readonly EntityManagerInterface $entityManager)
    {
    }
    #[Route(path: '/mercado/', name: 'mercado_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('mercado/index.html.twig', [
            'mercados' => $this->mercadoRepository->findAll(),
        ]);
    }
    #[Route(path: '/mercado/new', name: 'mercado_new', methods: ['GET'])]
    public function new(): Response
    {
        return $this->render('mercado/new.html.twig', [
            'action' => 'insert',
        ]);
    }
    #[Route(path: '/mercado/{id}', name: 'mercado_show', methods: ['GET'])]
    public function show(Mercado $mercado): Response
    {
        return $this->render('mercado/show.html.twig', [
            'mercado' => $mercado,
        ]);
    }
    #[Route(path: '/mercado/{id}/edit', name: 'mercado_edit', methods: ['GET'])]
    public function edit(int $id, Mercado $mercado): Response
    {
        $mercado = $this->mercadoRepository->find($id);

        return $this->render('mercado/edit.html.twig', [
            'mercado' => $mercado,
            'action' => 'update',
        ]);
    }
    #[Route(path: '/mercado/{id}/update', name: 'mercado_update', methods: ['POST'])]
    public function update(Request $request, int $id): Response
    {
        $mercado = $id === 0 ? new Mercado() : $this->mercadoRepository->find($id);
        $action = $request->request->get('action');
        $mercado->setName($request->request->get('name'));
        $mercado->setSlug($request->request->get('slug'));

        $this->entityManager->persist($mercado);

        // actually executes the queries (i.e. the INSERT query)
        $this->entityManager->flush();

        if ($action=='insert'){
            $this->addFlash('success', 'Mercado creado correctamente');
        }else{
            $this->addFlash('success', 'Mercado actualizado correctamente');
        }

        //$this->addFlash('error', ' Error al actualizar el Usuario');
        return $this->redirectToRoute('mercado_index', [], Response::HTTP_SEE_OTHER);

    }
    #[Route(path: '/mercado/{id}', name: 'mercado_delete', methods: ['POST'])]
    public function delete(Request $request, Mercado $mercado): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mercado->getId(), $request->request->get('_token'))) {
            $this->mercadoRepository->remove($mercado);
        }

        return $this->redirectToRoute('mercado_index', [], Response::HTTP_SEE_OTHER);
    }
}
