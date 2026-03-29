<?php

namespace App\Controller;

use App\Entity\Configuration;
use App\Repository\ConfigurationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConfigurationController extends AbstractController
{
    public function __construct(private readonly ConfigurationRepository $configurationRepository, private readonly EntityManagerInterface $entityManager)
    {
    }
    #[Route(path: '/configuration/', name: 'configuration_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('configuration/index.html.twig', [
            'configurations' => $this->configurationRepository->findAll(),
        ]);
    }
    #[Route(path: '/configuration/new', name: 'configuration_new', methods: ['GET'])]
    public function new(): Response
    {
        return $this->render('configuration/new.html.twig', [
            'action' => 'insert',
        ]);
    }
    #[Route(path: '/configuration/{id}', name: 'configuration_show', methods: ['GET'])]
    public function show(Configuration $configuration): Response
    {
        return $this->render('configuration/show.html.twig', [
            'configuration' => $configuration,
        ]);
    }
    #[Route(path: '/configuration/{id}/edit', name: 'configuration_edit', methods: ['GET'])]
    public function edit(int $id): Response
    {
        $configuration = $this->configurationRepository->find($id);

        return $this->render('configuration/edit.html.twig', [
            'configuration' => $configuration,
            'action' => 'update',
        ]);
    }
    #[Route(path: '/configuration/{id}/update', name: 'configuration_update', methods: ['POST'])]
    public function update(Request $request, int $id): Response
    {
        $configuration = $id === 0 ? new Configuration() : $this->configurationRepository->find($id);
        $action = $request->request->get('action');
        $configuration->setDescription($request->request->get('description'));
        $configuration->setValue($request->request->get('value'));

        $this->entityManager->persist($configuration);

        // actually executes the queries (i.e. the INSERT query)
        $this->entityManager->flush();

        if ($action=='insert'){
            $this->addFlash('success', 'Configuración creada correctamente');
        }else{
            $this->addFlash('success', 'Configuración actualizada correctamente');
        }

        //$this->addFlash('error', ' Error al actualizar el Usuario');
        return $this->redirectToRoute('configuration_index', [], Response::HTTP_SEE_OTHER);

    }
    #[Route(path: '/configuration/{id}', name: 'configuration_delete', methods: ['POST'])]
    public function delete(Request $request, Configuration $configuration): Response
    {
        if ($this->isCsrfTokenValid('delete'.$configuration->getId(), $request->request->get('_token'))) {
            $this->configurationRepository->remove($configuration);
        }

        return $this->redirectToRoute('configuration_index', [], Response::HTTP_SEE_OTHER);
    }
}
