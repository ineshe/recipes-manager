<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    #[Route('/category/{title}', name: 'app_category_show')]
    public function show(#[MapEntity(mapping: ['title' => 'title'])] Category $category) : Response
    {
        return $this->render('category/category.html.twig', [
            'category' => $category,
        ]);
    }

    public function all(EntityManagerInterface $entityManager, ?string $currentCategory) : Response {
        $categoryRepository = $entityManager->getRepository(Category::class);
        $categories = $categoryRepository->findAll();

        return $this->render('/partials/_header.html.twig', [
            'categories' => $categories,
            'currentCategory' => $currentCategory,
        ]);
    }
}