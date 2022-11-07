<?php

namespace App\Controller;

use App\Entity\Color;
use App\Entity\ColorVisit;
use App\Entity\Link;
use App\Entity\LinkVisit;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $doctrine)
    {
    }

    #[Route('/', name: 'app_homepage')]
    public function index(): Response
    {
        return $this->render('site/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    #[Route('/visit/{link}', name: 'app_user_links_visits')]
    public function visit(Request $request, Link $link): JsonResponse
    {
        $visit = new LinkVisit();
        $visit->setUserAgent($request->headers->get('User-Agent'));
        $visit->setLink($link);

        $this->doctrine->persist($visit);
        $this->doctrine->flush();

        return new JsonResponse(['success' => true]);
    }

    #[Route('/{name}', name: 'app_user_links')]
    public function links(User $user): Response
    {
        return $this->render('site/links.html.twig', [
            'user' => $user
        ]);
    }

    #[Route('/{name}/colors', name: 'app_user_colors')]
    public function colors(User $user): Response
    {
        $colors = [];
        $i = 0;
        foreach ($user->getColors() as $color) {
            $colors[$i]['value'] = $color->getValue();
            $colors[$i]['id'] = $color->getId();
            $colors[$i]['name'] = $color->getName();
            $colors[$i]['text'] = $color->getText();
            $colors[$i]['textColor'] = $color->getTextColor();
            $colors[$i]['nameColor'] = $color->getNameColor();
            $i++;
        }

        return $this->render('site/colors.html.twig', [
            'user' => $user,
            'colors' => $colors
        ]);
    }

    #[Route('/visit-color/{color}', name: 'app_user_colors_visits')]
    public function visitColor(Request $request, Color $color): JsonResponse
    {
        $visit = new ColorVisit();
        $visit->setUserAgent($request->headers->get('User-Agent'));
        $visit->setColor($color);

        $this->doctrine->persist($visit);
        $this->doctrine->flush();

        return new JsonResponse(['success' => true]);
    }
}
