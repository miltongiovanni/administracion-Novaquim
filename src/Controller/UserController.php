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
        /*$user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }*/

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
//check email  IMPORTANT
        /*if ($email = $request->request->get('email', false)) {
            if ($followId == 0) {
                if ($soiAppSuppliersUsersRepository->findOneBy(['email' => $email]) != null) {
                    $response = new JsonResponse(['idUser' => $user->getIdUser(), 'success' => false, 'message' => $this->ocTranslator->trans('users.exist.error')]);
                    return $response;
                }
            }
            if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $user->setEmail(trim($email));
                $user->setUsername(trim($email));
            } else {
                $response = new JsonResponse(['idUser' => $user->getIdUser(), 'success' => false, 'message' => $this->ocTranslator->trans('users.email.send.error')]);
                return $response;
            }


        }*/

        /*$form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

        }*/
        $this->addFlash('success', 'Usuario actualizado correctamente');
        $this->addFlash('error', ' Error al acualizar el Usuario');
        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);

    }

    /**
     * @Route("/{id}", name="user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }
}
