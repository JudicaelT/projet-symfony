<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Artist;

class ArtistFixture extends Fixture
{
    public const artist1_reference = 'artist_sinatra';

    public function load(ObjectManager $manager): void
    { 
        $artist1 = new Artist();
        $artist1->setName('Sinatra');
        $artist1->setFirstName('Frank');
        $artist1->setRole('Chanteur');

        $this->addReference(self::artist1_reference, $artist1);
        
        $manager->persist($artist1);
        $manager->flush();
    }
}
