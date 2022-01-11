<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Hall;

class HallFixture extends Fixture
{
    public const hall_reference = 'hall';

    public function load(ObjectManager $manager): void
    {
        $hall = new Hall();
        $hall->setName('Hall of fame')
               ->setAvailableTickets(400)
               ->setAddress('460, street of fame');

        $manager->persist($hall);
        $manager->flush();

        $this->addReference(self::hall_reference, $hall);
    }
}