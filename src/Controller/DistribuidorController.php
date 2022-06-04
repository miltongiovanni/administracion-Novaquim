<?php

namespace App\Controller;

use App\Entity\Distribuidor;
use App\Repository\DistribuidorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/distribuidor")
 */
class DistribuidorController extends AbstractController
{
    /**
     * @Route("/", name="distribuidor_index", methods={"GET"})
     */
    public function index(DistribuidorRepository $distribuidorRepository): Response
    {
        return $this->render('distribuidor/index.html.twig', [
            'distribuidors' => $distribuidorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="distribuidor_new", methods={"GET"})
     */
    public function new(Request $request, DistribuidorRepository $distribuidorRepository): Response
    {
        return $this->renderForm('distribuidor/new.html.twig', [
            'action' => 'insert',
        ]);
    }

    /**
     * @Route("/{id}", name="distribuidor_show", methods={"GET"})
     */
    public function show(Distribuidor $distribuidor): Response
    {
        return $this->render('distribuidor/show.html.twig', [
            'distribuidor' => $distribuidor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="distribuidor_edit", methods={"GET"})
     */
    public function edit(Request $request, int $id, DistribuidorRepository $distribuidorRepository): Response
    {
        $distribuidor = $distribuidorRepository->find($id);

        return $this->renderForm('distribuidor/edit.html.twig', [
            'distribuidor' => $distribuidor,
            'action' => 'update',
        ]);
    }
    /**
     * @Route("/{id}/update", name="distribuidor_update", methods={"POST"})
     */
    public function update(Request $request, int $id, EntityManagerInterface $entityManager, DistribuidorRepository $distribuidorRepository): Response
    {
        if ($id == 0) {
            $distribuidor = new Distribuidor();
        } else {
            $distribuidor = $distribuidorRepository->find($id);
        }

        $action = $request->request->get('action');
        $distribuidor->setDistribuidor($request->request->get('distribuidor'));
        $distribuidor->setContacto($request->request->get('contacto'));
        $distribuidor->setTelefono($request->request->get('telefono'));
        $distribuidor->setCelular($request->request->get('celular'));
        $distribuidor->setDireccion($request->request->get('direccion'));
        $distribuidor->setLongitud($request->request->get('longitud'));
        $distribuidor->setLatitud($request->request->get('latitud'));
        $distribuidor->setEstado($request->request->get('estado') ?? 0);

        $entityManager->persist($distribuidor);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        if ($action=='insert'){
            $this->addFlash('success', 'Distribuidor creado correctamente');
        }else{
            $this->addFlash('success', 'Distribuidor actualizado correctamente');
        }

        //$this->addFlash('error', ' Error al actualizar el Usuario');
        return $this->redirectToRoute('distribuidor_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/{id}", name="distribuidor_delete", methods={"POST"})
     */
    public function delete(Request $request, Distribuidor $distribuidor, DistribuidorRepository $distribuidorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$distribuidor->getId(), $request->request->get('_token'))) {
            $distribuidorRepository->remove($distribuidor, true);
        }

        return $this->redirectToRoute('distribuidor_index', [], Response::HTTP_SEE_OTHER);
    }
}
