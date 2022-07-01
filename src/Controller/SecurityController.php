<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
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

        return $this->render('security/forgot-password.html.twig', ['title' => 'Contraseña olvidada', 'web_title' => 'Industrias Novaquim S.A.S.']);
    }

    /**
     * @Route("/send-passcode", name="app_send_passcode")
     */
    public function sendPasscode(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $userEmail = $request->request->get('email');
        $passcode = rand(10000, 49999) + rand(1, 50000);
        $user = $userRepository->findOneBy(['email' => $userEmail]);
        $user->setPasscode($passcode);
        $entityManager->persist($user);
        $entityManager->flush();
        $email = ((new TemplatedEmail()))
            ->from(new Address('contacto@novaquim.com', 'Industrias Novaquim S.A.S.'))
            ->to($userEmail)
            //->cc('cc@example.com')
            //->bcc('miltongiovanni@gmail.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Reinicialización de la contraseña')

            // path of the Twig template to render
            ->htmlTemplate('emails/sendPasscode.html.twig')

            // pass variables (name => value) to the template
            ->context([
                'user' => $user,
                'passcode' => $passcode,
            ]);

        $mailer->send($email);
        return $this->render('security/send-passcode.html.twig',
            [
                'title' => 'Recuperación de contraseña',
                'web_title' => 'Industrias Novaquim S.A.S.',
                'email' => $userEmail,
                'passcode' => $passcode,
            ]);
    }

    /**
     * @Route("/check-passcode", name="app_check_passcode")
     */
    public function checkPasscode(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $userEmail = $request->request->get('email');
        $passcode = $request->request->get('passcode');
        $user = $userRepository->findOneBy(['email' => $userEmail]);//dd($user->getPasscode(), $passcode)

        ;
        if ($user->getPasscode() != $passcode) {
            // redirects to a route and maintains the original query string parameters
            //return $this->redirectToRoute('blog_show', $request->query->all());
            $this->addFlash('error', 'Código no válido. Intente de nuevo.');


            return $this->render('security/send-passcode.html.twig',
                [
                    'title' => 'Recuperación de contraseña',
                    'web_title' => 'Industrias Novaquim S.A.S.',
                    'email' => $userEmail,
                    'passcode' => $passcode,
                ]);
        }
        //dd($passcode);
        return $this->render('security/reset-password.html.twig',
            [
                'title' => 'Restablecimiento de la contraseña',
                'web_title' => 'Industrias Novaquim S.A.S.',
                'email' => $userEmail,
            ]);
    }

    /**
     * @Route("/reset-password", name="app_reset_password")
     */
    public function resetPassword(Request $request, UserPasswordHasherInterface $passwordHasher, UserRepository $userRepository, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $userEmail = $request->request->get('email');
        $password = $request->request->get('password');
        $password_confirmation = $request->request->get('password-confirmation');
        if ($password == $password_confirmation) {
            $user = $userRepository->findOneBy(['email' => $userEmail]);
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $password
            );
            $user->setPassword($hashedPassword);
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Contraseña actualizada correctamente');
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);

        } else {
            $this->addFlash('error', 'Las contraseñas no son iguales');
            return $this->render('security/reset-password.html.twig',
                [
                    'title' => 'Restablecimiento de la contraseña',
                    'web_title' => 'Industrias Novaquim S.A.S.',
                    'email' => $userEmail,
                ]);
        }

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
