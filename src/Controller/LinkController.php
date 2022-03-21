<?php

namespace App\Controller;

use App\Entity\Link;
use App\Entity\User;
use App\Form\LinkType;
use App\Repository\LinkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dashboard/link')]
class LinkController extends AbstractController
{
    #[Route('/', name: 'app_link_index', methods: ['GET'])]
    public function index(): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('link/index.html.twig', [
            'links' => $user->getLinks(),
        ]);
    }

    #[Route('/dashboard/link/new', name: 'app_link_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LinkRepository $linkRepository): Response
    {
        $link = new Link();
        $form = $this->createForm(LinkType::class, $link);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $linkRepository->add($link);
            return $this->redirectToRoute('app_link_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('link/new.html.twig', [
            'link' => $link,
            'form' => $form,
        ]);
    }

    #[Route('/dashboard/link/{id}', name: 'app_link_show', methods: ['GET'])]
    public function show(Link $link): Response
    {
        $this->denyAccessUnlessGranted('EDIT', $link);

        return $this->render('link/show.html.twig', [
            'link' => $link,
        ]);
    }

    #[Route('/dashboard/link/{id}/edit', name: 'app_link_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Link $link, LinkRepository $linkRepository): Response
    {
        $this->denyAccessUnlessGranted('EDIT', $link);

        $form = $this->createForm(LinkType::class, $link);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $linkRepository->add($link);
            return $this->redirectToRoute('app_link_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('link/edit.html.twig', [
            'link' => $link,
            'form' => $form,
        ]);
    }

    #[Route('/dashboard/link/{id}', name: 'app_link_delete', methods: ['POST'])]
    public function delete(Request $request, Link $link, LinkRepository $linkRepository): Response
    {
        $this->denyAccessUnlessGranted('EDIT', $link);

        if ($this->isCsrfTokenValid('delete' . $link->getId(), $request->request->get('_token'))) {
            $linkRepository->remove($link);
        }

        return $this->redirectToRoute('app_link_index', [], Response::HTTP_SEE_OTHER);
    }
}
