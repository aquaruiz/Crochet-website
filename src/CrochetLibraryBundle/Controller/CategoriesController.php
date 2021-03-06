<?php

namespace CrochetLibraryBundle\Controller;

use CrochetLibraryBundle\Entity\Category;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends Controller
{
    /**
     * @Route("/category/{id}", name="category_view")
     * @param Connection $connection
     * @param Category $category
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listByIdAction(Connection $connection, Category $category)
    {
        $catId = $category->getId();
        $patterns = $connection->fetchAll('
SELECT *
from patterns
inner join patterns_categories as mix
where patterns.id = mix.pattern_id 
AND mix.category_id = :id', ['id' => $catId]);

//        var_dump($patterns);
        return $this->render('categories/view.html.twig', [
            'patterns' => $patterns,
            'category' => $category
        ]);
    }

    /**
     * @Route("/categories", name="categories_view")
     * @param Connection $connection
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAllAction(Connection $connection)
    {
        $categories = $connection->fetchAll('
SELECT *
from categories');

//        var_dump($categories);
        return $this->render('categories/listAll.html.twig', [
            'categories' => $categories
        ]);
    }
}