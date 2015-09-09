<?php
/**
 * Created by PhpStorm.
 * User: ghenao
 * Date: 09/12/2014
 * Time: 10:27
 */

namespace Ip\AttractifBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ip\AttractifBundle\Entity\Category;
use Ip\AttractifBundle\Entity\Product;

class LoadProducts implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $product = new Product();
        $category = new Category();
        $category->setName("Informatique");
        $category->setDescription("Lorem ipsum ...");

        $product->setName("Computer");
        $product->setDescription("this computer blabla");
        $product->setPrice(560);
        $product->setRef("RFR23");
        $product->setImage("");
        $product->setStock(50);
        $product->setCategory($category);

        $manager->persist($category);
        $manager->persist($product);
        $manager->flush();
    }
} 