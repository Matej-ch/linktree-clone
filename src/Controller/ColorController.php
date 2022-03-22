<?php

namespace App\Controller;

use App\Entity\Color;
use App\Entity\User;
use App\Form\ColorType;
use App\Repository\ColorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dashboard/colors')]
class ColorController extends AbstractController
{
    #[Route('/', name: 'app_color_index', methods: ['GET'])]
    public function index(ColorRepository $colorRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('color/index.html.twig', [
            'colors' => $user->getColors(),
        ]);
    }

    #[Route('/new', name: 'app_color_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ColorRepository $colorRepository): Response
    {
        $color = new Color();
        $form = $this->createForm(ColorType::class, $color);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $color->setUser($this->getUser());
            $colorRepository->add($color);
            return $this->redirectToRoute('app_color_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('color/new.html.twig', [
            'color' => $color,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_color_show', methods: ['GET'])]
    public function show(Color $color): Response
    {
        $this->denyAccessUnlessGranted('EDIT', $color);

        return $this->render('color/show.html.twig', [
            'color' => $color,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_color_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Color $color, ColorRepository $colorRepository): Response
    {
        $this->denyAccessUnlessGranted('EDIT', $color);

        $form = $this->createForm(ColorType::class, $color);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $colorRepository->add($color);
            return $this->redirectToRoute('app_color_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('color/edit.html.twig', [
            'color' => $color,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_color_delete', methods: ['POST'])]
    public function delete(Request $request, Color $color, ColorRepository $colorRepository): Response
    {
        $this->denyAccessUnlessGranted('EDIT', $color);

        if ($this->isCsrfTokenValid('delete' . $color->getId(), $request->request->get('_token'))) {
            $colorRepository->remove($color);
        }

        return $this->redirectToRoute('app_color_index', [], Response::HTTP_SEE_OTHER);
    }
}
