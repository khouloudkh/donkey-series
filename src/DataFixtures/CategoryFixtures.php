<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $category = new Category();
        $category->setName('Horreur');
        $manager->persist($category);

        $category = new Category();
        $category->setName('Comedy');
        $manager->persist($category);

        $category = new Category();
        $category->setName('Action');
        $manager->persist($category);

        $category = new Category();
        $category->setName('Fantasy');
        $manager->persist($category);

        $category = new Category();
        $category->setName('science fiction');
        $manager->persist($category);

        $category = new Category();
        $category->setName('Animation');
        $manager->persist($category);
    
        
        $manager->flush();
    }
}
