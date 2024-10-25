<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Attribute\Route;

class RecipeController extends AbstractController
{
    #[Route('/recipe/{id}', name: 'app_recipe_show')]
    public function show(int $id, RecipeRepository $recipeRepository, Request $request) : Response 
    {
        $servings = $request->query->get('servings', '4');

        if (+$servings < 1) {
            throw new BadRequestHttpException('Portionen müssen mindestens 1 sein.');
        }
        
        $recipe = $recipeRepository->find($id);
        if(!$recipe) {
            throw $this->createNotFoundException('Recipe not found');
        }

        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
            'servings' => $servings,
        ]);
    }

    #[Route('/search', name: 'app_recipe_search')]
    public function search(RecipeRepository $recipeRepository, Request $request) : Response
    {
        $searchTerm = $request->query->get('search');

        $recipes = $recipeRepository->findByTitleField($searchTerm);

        return $this->render('recipe/search.html.twig', [
            'recipes' => $recipes,
        ]);
    }
}

