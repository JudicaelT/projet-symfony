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
        // Creating an admin with datafixtures
        $user = new User();
        $user->setEmail('admin@gmail.com')
             ->setRoles(['ROLE_ADMIN'])
             ->setFirstName('Toto')
             ->setLastName('Duzero')
             ->setPassword(password_hash('password', PASSWORD_BCRYPT));

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::user_reference, $user);
    }
}
