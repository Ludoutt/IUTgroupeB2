<?php
namespace App\Controller;

use App\Repository\BacklogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
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
}
