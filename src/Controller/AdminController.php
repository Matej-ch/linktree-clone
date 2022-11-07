<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route('/dashboard/admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'app_admin', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {

        return $this->render('admin/index.html.twig', [
            'users' => $userRepository->findAll()
        ]);
    }

    #[Route('/user/{id}', name: 'app_admin_view', methods: ['GET'])]
    public function view(User $user): Response
    {
        $links = $user->getLinks();
        $colors = $user->getColors();

        return $this->render('admin/view.html.twig', [
            'user' => $user,
            'links' => $links,
            'colors' => $colors
        ]);
    }
}