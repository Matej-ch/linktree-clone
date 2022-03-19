<?php

namespace App\Controller;

use App\Entity\Link;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LinkController extends AbstractController
{
    #[Route('/link', name: 'app_link')]
    public function index(): Response
    {
        return $this->render('link/index.html.twig', [
            'controller_name' => 'LinkController',
        ]);
    }

    #[Route('/link/edit/{id}', name: 'app_link_edit')]
    public function edit(Link $link): Response
    {
        $this->denyAccessUnlessGranted('EDIT', $link);

        return $this->render('link/edit.html.twig', []);
    }
}
