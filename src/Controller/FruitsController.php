<?php

namespace App\Controller;

use App\Entity\Fruits;
use App\Repository\FruitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FruitsController extends AbstractController
{
    #[Route('/fruits', name: 'fruits')]
    public function index(FruitsRepository $fruitsRepository): Response
    {
        $fruits = $fruitsRepository->findAll();
        return $this->render('fruits/index.html.twig', [
            'fruits' => $fruits,
        ]);
    }

    #[Route('/fruits/show/{id}', name: 'show_fruit')]
    public function show(Fruits $fruits): Response
    {
        return $this->render('fruits/show.html.twig', [
               'fruits' => $fruits,
        ]);
    }

    #[Route('/fruits/delete/{id}', name: 'delete_fruit')]
    public function delete(FruitsRepository $fruitsRepository, EntityManagerInterface $manager, Fruits $fruits): Response
    {
        $manager->remove($fruits);
        $manager->flush();
        return $this->redirectToRoute('fruits');
    }
}
