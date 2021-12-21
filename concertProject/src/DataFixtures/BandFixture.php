<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Band;

class BandFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $band1 = new Band();
        $band1 = setName('Frank Sinatra');
        $band1->addArtist($this->getReference(ArtistFixture::artist1_reference));

        $manager->persist($band1);
        $manager->flush();
    }
}
