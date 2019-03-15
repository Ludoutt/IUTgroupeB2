<?php

namespace App\Controller;

use App\Entity\Backlog;
use App\Entity\Element;
use App\Form\BacklogType;
use App\Repository\BacklogRepository;
use App\Repository\ElementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backlog")
 */
class BacklogController extends AbstractController
{
    /**
     * @Route("/", name="backlog_index", methods={"GET"})
     */
    public function index(BacklogRepository $backlogRepository): Response
    {
        return $this->render('backlog/index.html.twig', [
            'backlogs' => $backlogRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="backlog_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $backlog = new Backlog();
        $form = $this->createForm(BacklogType::class, $backlog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($backlog);
            $entityManager->flush();

            return $this->redirectToRoute('backlog_index');
        }

        return $this->render('backlog/new.html.twig', [
            'backlog' => $backlog,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="backlog_show", methods={"GET"})
     */
    public function show(Backlog $backlog, ElementRepository $elementRepository): Response
    {
        $accepter = $elementRepository->findBy(["status" => 0], ['priority' => 'DESC']); // les propositions d'éléments (colonne à vérifier)
        $estimer = $elementRepository->findBy(["status" => 1], ['priority' => 'DESC']); // les éléments acceptés par le PO (colonne en attente d'estimation par les dév)
        $planifier = $elementRepository->findBy(["status" => 2], ['priority' => 'DESC']); // les éléments estimés par les dév, donc en attente de planif par le PO

        return $this->render('home.html.twig', [
            'backlog' => $backlog,
            'accepter' => $accepter,
            'estimer' => $estimer,
            'planifier' => $planifier
        ]);
    }

    /**
     * @Route("/{id}/edit", name="backlog_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Backlog $backlog): Response
    {
        $form = $this->createForm(BacklogType::class, $backlog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('backlog_index', [
                'id' => $backlog->getId(),
            ]);
        }

        return $this->render('backlog/edit.html.twig', [
            'backlog' => $backlog,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="backlog_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Backlog $backlog): Response
    {
        if ($this->isCsrfTokenValid('delete' . $backlog->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($backlog);
            $entityManager->flush();
        }

        return $this->redirectToRoute('backlog_index');
    }
}
