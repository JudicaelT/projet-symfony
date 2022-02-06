<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixture extends Fixture
{
    public const user_reference = 'user';

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('judicael.terrisse@etu.univ-amu.fr')
             ->setRoles(['User'])
             ->setFirstName('Toto')
             ->setLastName('Duzero')
             ->setPassword(password_hash('pass', PASSWORD_BCRYPT));

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::user_reference, $user);
    }
}
