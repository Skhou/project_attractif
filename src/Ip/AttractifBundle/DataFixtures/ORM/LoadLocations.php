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
use Ip\AttractifBundle\Entity\Location;

class LoadLocations implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $locationNames = array("Chateau de Vincennes", "BHV", "Carrefour Bercy");

        foreach($locationNames as $name) {

            $location = new Location();
            $location->setName($name);
            $location->setAddress("12 rue de tour");
            $location->setZipcode("75012");
            $location->setCity("Paris");
            $manager->persist($location);
        }

        $manager->flush();
    }
} 