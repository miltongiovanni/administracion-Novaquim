<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET"})
     */
    public function new(Request $request): Response
    {

        return $this->renderForm('user/new.html.twig', [
            'action' => 'insert',
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET"})
     */
    public function edit(Request $request, int $id, UserRepository $userRepository): Response
    {
        $currentUser = $this->getUser($id);
        $user = $userRepository->find($id);

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'action' => 'update',
        ]);
    }

    /**
     * @Route("/{id}/update", name="user_update", methods={"POST"})
     */
    public function update(Request $request, int $id, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        if ($id == 0) {
            $user = new User();
        } else {
            $user = $userRepository->find($id);
        }
        $action = $request->request->get('action');
        $user->setEmail($request->request->get('email'));
        $user->setRoles([$request->request->get('role')]);
        $plaintextPassword = $request->request->get('password', false);
        $plaintextPasswordConfirmation = $request->request->get('password-confirmation', false);
        if ($plaintextPassword) {
            if ($plaintextPassword == $plaintextPasswordConfirmation) {
                $hashedPassword = $passwordHasher->hashPassword(
                    $user,
                    $plaintextPassword
                );
                $user->setPassword($hashedPassword);
            }
        }
        $entityManager->persist($user);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        if ($action=='insert'){
            $this->addFlash('success', 'Usuario creado correctamente');
        }else{
            $this->addFlash('success', 'Usuario actualizado correctamente');
        }

        //$this->addFlash('error', ' Error al actualizar el Usuario');
        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);

    }

    /**
     * @Route("/{id}", name="user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user, UserRepository  $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user);
        }

        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }
}
