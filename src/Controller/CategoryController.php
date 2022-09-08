<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{

    #[Route('/', name: 'index')]
    public function index(
        CategoryRepository $CategoryRepository
    ): Response
    {
        $categories = $CategoryRepository->findAll();
        
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'categories' => $categories,
        ]);
    }

    #[Route('/{CategoryName}', name: 'show')]
    public function show(
        CategoryRepository $CategoryRepository,
        ProgramRepository $ProgramRepository,
        string $CategoryName): Response
    {

        $category = $CategoryRepository->findOneBy(['name' => $CategoryName,]);
        if (!$category) {
            throw $this->createNotFoundException('Aucune catégorie avec ce nom n’est présente en base');
        }


        $programs = $ProgramRepository->findBy(
            ['category' => $category->getId()],
            ['id' => 'DESC'],
            3,
        );
        if (!$programs) {
            throw $this->createNotFoundException("Aucune série trouvée");
        } 


        return $this->render('category/show.html.twig', [
            'programs' => $programs,
            'categoryName' => $CategoryName,
        ]);
    }
    
}
