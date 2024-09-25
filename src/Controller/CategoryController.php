<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/main-dishes', name: 'app_category_main_dishes')]
    public function mainDishes() : Response {
        return $this->render('category/main_dishes.html.twig');
    }
}