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
use Ip\AttractifBundle\Entity\User;

class LoadUsers implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setEmail("user1@user.fr")
            ->setAuthKey("")
            ->setBlockedAt(2)
            ->setConfirmedAt(2)
            ->setFlags(1)
            ->setPasswordHash("")
            ->setRegistrationIp(2)
            ->setUnconfirmedEmail("")
            ->setCreatedAt(2)
            ->setUpdatedAt(1)
            ->setRole("user")
            ->setUsername("user1");

        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail("user2@user.fr")
            ->setAuthKey("")
            ->setBlockedAt(2)
            ->setConfirmedAt(2)
            ->setFlags(1)
            ->setPasswordHash("")
            ->setRegistrationIp(2)
            ->setCreatedAt(2)
            ->setUnconfirmedEmail("")
            ->setUpdatedAt(1)
            ->setRole("user")
            ->setUsername("user2");

        $manager->persist($user2);
        $manager->flush();
    }
} 