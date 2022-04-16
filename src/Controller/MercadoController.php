<?php

namespace App\Controller;

use App\Entity\Mercado;
use App\Form\MercadoType;
use App\Repository\MercadoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mercado")
 */
class MercadoController extends AbstractController
{
    /**
     * @Route("/", name="mercado_index", methods={"GET"})
     */
    public function index(MercadoRepository $mercadoRepository): Response
    {
        return $this->render('mercado/index.html.twig', [
            'mercados' => $mercadoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="mercado_new", methods={"GET"})
     */
    public function new(Request $request, MercadoRepository $mercadoRepository): Response
    {
        return $this->renderForm('mercado/new.html.twig', [
            'action' => 'insert',
        ]);
    }

    /**
     * @Route("/{id}", name="mercado_show", methods={"GET"})
     */
    public function show(Mercado $mercado): Response
    {
        return $this->render('mercado/show.html.twig', [
            'mercado' => $mercado,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mercado_edit", methods={"GET"})
     */
    public function edit(Request $request, int $id, Mercado $mercado, MercadoRepository $mercadoRepository): Response
    {
        $mercado = $mercadoRepository->find($id);

        return $this->renderForm('mercado/edit.html.twig', [
            'mercado' => $mercado,
            'action' => 'update',
        ]);
    }

    /**
     * @Route("/{id}/update", name="mercado_update", methods={"POST"})
     */
    public function update(Request $request, int $id, EntityManagerInterface $entityManager, MercadoRepository $mercadoRepository): Response
    {
        if ($id == 0) {
            $mercado = new Mercado();
        } else {
            $mercado = $mercadoRepository->find($id);
        }
        $action = $request->request->get('action');
        $mercado->setName($request->request->get('name'));
        $mercado->setSlug($request->request->get('slug'));

        $entityManager->persist($mercado);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        if ($action=='insert'){
            $this->addFlash('success', 'Mercado creado correctamente');
        }else{
            $this->addFlash('success', 'Mercado actualizado correctamente');
        }

        //$this->addFlash('error', ' Error al actualizar el Usuario');
        return $this->redirectToRoute('mercado_index', [], Response::HTTP_SEE_OTHER);

    }


    /**
     * @Route("/{id}", name="mercado_delete", methods={"POST"})
     */
    public function delete(Request $request, Mercado $mercado, MercadoRepository $mercadoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mercado->getId(), $request->request->get('_token'))) {
            $mercadoRepository->remove($mercado);
        }

        return $this->redirectToRoute('mercado_index', [], Response::HTTP_SEE_OTHER);
    }
}
