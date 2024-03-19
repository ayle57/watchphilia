<?php

namespace App\Controller\Profile;

use App\Form\ProfileEditType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[isGranted('ROLE_USER')]
class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'profile.index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('profile/index.html.twig');
    }

    #[Route('/profile/edit/{id}', name: 'profile.edit', methods: ['GET', 'POST'])]
    public function edit(User $user, Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProfileEditType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userData = $form->getData();

            $user->setUsername($userData->getUsername());
            $user->setEmail($userData->getEmail());

            if (!empty($userData->getPassword())) {
                $encodedPassword = $passwordHasher->hashPassword($user, $userData->getPassword());
                $user->setPassword($encodedPassword);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('profile.index', ['id' => $user->getId()]);
        }

        return $this->render('profile/edit.html.twig', [
            'profileEditForm' => $form
        ]);
    }

    #[Route('/profile/delete/{id}', name: 'profile.delete', methods: ['GET', 'DELETE'])]
    public function delete(User $user, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($user);
        $entityManager->flush();
        return $this->redirectToRoute('index.home');
    }
}
