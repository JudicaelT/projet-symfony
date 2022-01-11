<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Follower;

class FollowerFixture extends Fixture
{
    public const follower_reference = 'follower';

    public function load(ObjectManager $manager): void
    {
        $follower = new Follower();
        $follower->setFirstName('Toto')
                 ->setLastName('Zero')
                 ->setMail('toto0@outlook.com');

        $manager->persist($follower);
        $manager->flush();

        $this->addReference(self::follower_reference, $follower);
    }
}