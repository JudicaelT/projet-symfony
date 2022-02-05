<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Band;

class BandFixture extends Fixture
{
    public const band_reference = 'band';
    public function load(ObjectManager $manager): void
    {
        $band = new Band();
        $band->setName('David Bowie')
             ->setLogo('testImg.jpg');

        $manager->persist($band);
        $manager->flush();

        $this->addReference(self::band_reference, $band);
    }
}