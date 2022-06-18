<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error, 'title' => 'Acceso', 'web_title' => 'Industrias Novaquim S.A.S.']);
    }

    /**
     * @Route("/forgot-password", name="app_forgot_password")
     */
    public function forgotPassword(UserRepository $userRepository): Response
    {

        return $this->render('security/forgot-password.html.twig', [ 'title' => 'Contraseña olvidada', 'web_title' => 'Industrias Novaquim S.A.S.']);
    }

    /**
     * @Route("/send-passcode", name="app_send_passcode")
     */
    public function sendPasscode(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $email = $request->request->get('email');
        $passcode = rand(10000, 49999) + rand(1, 50000);
        $user = $userRepository->findOneBy(['email' => $email]);
        $user->setPasscode($passcode);
        $entityManager->persist($user);
        $entityManager->flush();
        $email = (new Email())
            ->from('contacto@novaquim.com')
            ->to($email)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);
        dd($email,$passcode, $user);
        return $this->render('security/forgot-password.html.twig', [ 'title' => 'Contraseña olvidada', 'web_title' => 'Industrias Novaquim S.A.S.']);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        //throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
        return $this->redirectToRoute('app_login');
    }
}
