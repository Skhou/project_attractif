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

class LoadCategories implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $catNames = array("hifi", "telephonie", "dvd");

        foreach($catNames as $name) {

            $category = new Category();
            $category->setName($name);
            $category->setDescription("Lorem ipsum ...");
            $manager->persist($category);
        }

        $manager->flush();
    }
} 