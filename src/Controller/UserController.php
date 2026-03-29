<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    public function __construct(private readonly UserRepository $userRepository, private readonly UserPasswordHasherInterface $passwordHasher, private readonly EntityManagerInterface $entityManager)
    {
    }
    #[Route(path: '/user/', name: 'user_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $this->userRepository->findAll(),
        ]);
    }
    #[Route(path: '/user/new', name: 'user_new', methods: ['GET'])]
    public function new(): Response
    {
        return $this->render('user/new.html.twig', [
            'action' => 'insert',
        ]);
    }
    #[Route(path: '/user/{id}', name: 'user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }
    #[Route(path: '/user/{id}/edit', name: 'user_edit', methods: ['GET'])]
    public function edit(int $id): Response
    {
        $this->getUser();
        $user = $this->userRepository->find($id);

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'action' => 'update',
        ]);
    }
    #[Route(path: '/user/{id}/update', name: 'user_update', methods: ['POST'])]
    public function update(Request $request, int $id): Response
    {
        $user = $id === 0 ? new User() : $this->userRepository->find($id);
        $action = $request->request->get('action');
        $user->setEmail($request->request->get('email'));
        $user->setRoles([$request->request->get('role')]);
        $plaintextPassword = $request->request->get('password', false);
        $plaintextPasswordConfirmation = $request->request->get('password-confirmation', false);
        if ($plaintextPassword && $plaintextPassword == $plaintextPasswordConfirmation) {
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);
        }
        $this->entityManager->persist($user);

        // actually executes the queries (i.e. the INSERT query)
        $this->entityManager->flush();

        if ($action=='insert'){
            $this->addFlash('success', 'Usuario creado correctamente');
        }else{
            $this->addFlash('success', 'Usuario actualizado correctamente');
        }

        //$this->addFlash('error', ' Error al actualizar el Usuario');
        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);

    }
    #[Route(path: '/user/{id}', name: 'user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $this->userRepository->remove($user);
        }

        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }
}
