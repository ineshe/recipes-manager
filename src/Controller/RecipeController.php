<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecipeController extends AbstractController
{
    #[Route('/recipe/{id}', name: 'app_recipe_show')]
    public function show(int $id, RecipeRepository $recipeRepository ) : Response 
    {
        $recipe = $recipeRepository->find($id);
        if(!$recipe) {
            throw $this->createNotFoundException('Recipe not found');
        }

        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
        ]);
    }
}

