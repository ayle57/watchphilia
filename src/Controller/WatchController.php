<?php

namespace App\Controller;

use App\Entity\Watch;
use App\Repository\WatchRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class WatchController extends AbstractController
{
    #[Route('/watch', name: 'watch.index')]
    public function index(WatchRepository $watchRepository): Response
    {
        $watches = $watchRepository->findAll();
        return $this->render('watch/index.html.twig', [
            'watches' => $watches
        ]);
    }

    #[Route('/watch/show/{id}', name: 'watch.show')]
    public function show(Watch $watch, WatchRepository $watchRepository): Response
    {
        return $this->render('watch/show.html.twig', [
            'watch' => $watch
        ]);
    }
}
