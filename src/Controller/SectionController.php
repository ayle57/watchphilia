<?php

namespace App\Controller;

use App\Entity\Section;
use App\Repository\SectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class SectionController extends AbstractController
{
    #[Route('/section', name: 'section.index')]
    public function index(SectionRepository $sectionRepository): Response
    {
        $sections = $sectionRepository->findAll();
        return $this->render('section/index.html.twig', [
            'sections' => $sections
        ]);
    }

    #[Route('/section/show/{id}', name: 'section.show')]
    public function show(Section $section): Response
    {
        $watches = $section->getWatches();
        return $this->render('section/show.html.twig', [
            'section' => $section,
            'watches' => $watches
        ]);
    }
}
