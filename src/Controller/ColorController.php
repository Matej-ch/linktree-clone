<?php

namespace App\Controller;

use App\Entity\Color;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ColorController extends AbstractController
{
    #[Route('/dashboard/color', name: 'app_color')]
    public function index(): Response
    {
        return $this->render('color/index.html.twig', [
            'controller_name' => 'ColorController',
        ]);
    }

    #[Route('/dashboard/color/edit/{id}', name: 'app_color_edit')]
    public function edit(Color $color): Response
    {

        $this->denyAccessUnlessGranted('EDIT', $color);

        return $this->render('color/edit.html.twig', []);
    }
}
