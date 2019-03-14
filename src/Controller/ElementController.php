<?php

namespace App\Controller;

use App\Entity\Element;
use App\Form\ElementType;
use App\Repository\ElementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/element")
 */
class ElementController extends AbstractController
{
    /**
     * @Route("/", name="element_index", methods={"GET"})
     */
    public function index(ElementRepository $elementRepository): Response
    {
        return $this->render('element/index.html.twig', [
            'elements' => $elementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="element_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $element = new Element();
        $form = $this->createForm(ElementType::class, $element);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $element->setCreatedBy($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($element);
            $entityManager->flush();

            $this->addFlash(
                'conf',
                'Elément créé'
            );

            return $this->redirectToRoute('backlog_show', ['id' => $element->getBacklog()->getId()]);
        }

        return $this->render('element/new.html.twig', [
            'element' => $element,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="element_show", methods={"GET"})
     */
    public function show(Element $element): Response
    {
        return $this->render('element/show.html.twig', [
            'element' => $element,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="element_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Element $element): Response
    {
        $form = $this->createForm(ElementType::class, $element);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $save = $form->getData();
            if (!empty($save->getEstimation()) && $save->getStatus() != 2)
            {
                $save->setStatus(2);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($save);
            $em->flush();

            $this->addFlash(
                'conf',
                'Elément mis à jour'
            );

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('backlog_show', [
                'id' => $element->getBacklog()->getId(),
            ]);
        }

        return $this->render('element/edit.html.twig', [
            'element' => $element,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="element_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Element $element): Response
    {
        if ($this->isCsrfTokenValid('delete'.$element->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($element);
            $entityManager->flush();
        }

        return $this->redirectToRoute('element_index');
    }
}
