<?php

namespace App\Controller;

use App\Entity\Recipe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(EntityManagerInterface $entityManager) : Response 
    {
        $recipeRepository = $entityManager->getRepository(Recipe::class);
        $recipes = $recipeRepository->findAll();
        
        return $this->render('main/homepage.html.twig', [
            'recipes' => $recipes,
        ]);
    }
}

