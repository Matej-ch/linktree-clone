<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(): Response
    {
        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    #[Route('/visit/{link}', name: 'app_user_links_visits')]
    public function visit()
    {

    }

    #[Route('/{name}', name: 'app_user_links')]
    public function links()
    {

    }

    #[Route('/{name}/colors', name: 'app_user_colors')]
    public function colors()
    {

    }
}
