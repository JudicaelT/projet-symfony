<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Organiser;

class OrganiserFixture extends Fixture
{
    public const organiser_reference = 'organiser';
    public function load(ObjectManager $manager): void
    {
        $organiser = new Organiser();
        $organiser->setFirstName('John')
               ->setLastName('Doe')
               ->setPhone('0636730017')
               ->setMail('john.doe@gmail.com')
               ->setPassword(md5('pass123456'));

        $manager->persist($organiser);
        $manager->flush();

        $this->addReference(self::organiser_reference, $organiser);
    }
}