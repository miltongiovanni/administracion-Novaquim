<?php

namespace App\Controller;

use App\Entity\Configuration;
use App\Form\ConfigurationType;
use App\Repository\ConfigurationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/configuration")
 */
class ConfigurationController extends AbstractController
{
    /**
     * @Route("/", name="configuration_index", methods={"GET"})
     */
    public function index(ConfigurationRepository $configurationRepository): Response
    {
        return $this->render('configuration/index.html.twig', [
            'configurations' => $configurationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="configuration_new", methods={"GET"})
     */
    public function new(Request $request): Response
    {
        return $this->renderForm('configuration/new.html.twig', [
            'action' => 'insert',
        ]);
    }

    /**
     * @Route("/{id}", name="configuration_show", methods={"GET"})
     */
    public function show(Configuration $configuration): Response
    {
        return $this->render('configuration/show.html.twig', [
            'configuration' => $configuration,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="configuration_edit", methods={"GET"})
     */
    public function edit(Request $request, int $id, ConfigurationRepository $configurationRepository): Response
    {
        $configuration = $configurationRepository->find($id);

        return $this->renderForm('configuration/edit.html.twig', [
            'configuration' => $configuration,
            'action' => 'update',
        ]);
    }

    /**
     * @Route("/{id}/update", name="configuration_update", methods={"POST"})
     */
    public function update(Request $request, int $id, EntityManagerInterface $entityManager, ConfigurationRepository $configurationRepository): Response
    {
        if ($id == 0) {
            $configuration = new Configuration();
        } else {
            $configuration = $configurationRepository->find($id);
        }
        $action = $request->request->get('action');
        $configuration->setDescription($request->request->get('description'));
        $configuration->setValue($request->request->get('value'));

        $entityManager->persist($configuration);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        if ($action=='insert'){
            $this->addFlash('success', 'Configuración creada correctamente');
        }else{
            $this->addFlash('success', 'Configuración actualizada correctamente');
        }

        //$this->addFlash('error', ' Error al actualizar el Usuario');
        return $this->redirectToRoute('configuration_index', [], Response::HTTP_SEE_OTHER);

    }
    /**
     * @Route("/{id}", name="configuration_delete", methods={"POST"})
     */
    public function delete(Request $request, Configuration $configuration, ConfigurationRepository $configurationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$configuration->getId(), $request->request->get('_token'))) {
            $configurationRepository->remove($configuration);
        }

        return $this->redirectToRoute('configuration_index', [], Response::HTTP_SEE_OTHER);
    }
}
