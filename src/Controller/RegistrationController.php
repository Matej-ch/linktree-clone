<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request                     $request,
                             UserPasswordHasherInterface $userPasswordHasher,
                             EntityManagerInterface      $entityManager,
                             VerifyEmailHelperInterface  $verifyEmailHelper,
                             MailerInterface             $mailer,
                             string                      $adminEmail): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setRoles(['ROLE_USER']);
            $entityManager->persist($user);
            $entityManager->flush();

            $signatureComponents = $verifyEmailHelper->generateSignature(
                'app_verify_email',
                $user->getId(),
                $user->getEmail(),
                ['id' => $user->getId()],
            );

            $email = (new TemplatedEmail())
                ->from(new Address($adminEmail))
                ->to(new Address($user->getEmail(), $user->getName()))
                ->subject("Linkify - confirm your email")
                ->htmlTemplate('emails/registration.html.twig')
                ->context(['emailUrl' => $signatureComponents->getSignedUrl()
                ]);

            try {
                $mailer->send($email);
                $this->addFlash('success', 'Confirmation email was sent to your email');
            } catch (TransportExceptionInterface $e) {
                $this->addFlash('success', 'Email error: ' . $e->getMessage());
            }

            return $this->redirectToRoute('app_homepage');
        }

        $response = new Response(null, $form->isSubmitted() ? 422 : 200);

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ], $response);
    }

    #[Route('/verify', name: 'app_verify_email')]
    public function verifyUserEmail(Request                    $request,
                                    VerifyEmailHelperInterface $verifyEmailHelper,
                                    UserRepository             $userRepository,
                                    EntityManagerInterface     $entityManager): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $user = $userRepository->find($request->query->get('id'));
        if (!$user) {
            throw $this->createNotFoundException();
        }

        try {
            $verifyEmailHelper->validateEmailConfirmation(
                $request->getUri(),
                $user->getId(),
                $user->getEmail(),
            );
        } catch (VerifyEmailExceptionInterface $e) {
            $this->addFlash('error', $e->getReason());

            return $this->redirectToRoute('app_register');
        }

        $user->setIsVerified(true);

        $entityManager->flush();

        $this->addFlash('success', 'Account verified! You can now log in.');

        return $this->redirectToRoute('app_login');
    }

    #[Route('/verify/resend', name: 'app_verify_resend_email')]
    public function resendVerifyEmail(): Response
    {
        return $this->render('registration/resend_verify_email.html.twig');
    }
}
