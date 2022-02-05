<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\OrganiserFixture;
use App\DataFixtures\HallFixture;
use App\DataFixtures\BandFixture;
use App\DataFixtures\FollowerFixture;
use App\Entity\Concert;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;     // We use this to load 'OrganiserFixture' and 'HallFixture' first

class ConcertFixture extends Fixture implements DependentFixtureInterface
{
    public const concert_reference = 'concert';

    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 4; $i++) {
            $concert = new Concert();
            $concert->setName('Blessed and Possessed')
                    ->setDateStart(\DateTime::createFromFormat('d-m-Y', '30-03-2022'))
                    ->setDateEnd(\DateTime::createFromFormat('d-m-Y', '31-03-2022'))
                    ->setLogo('blessedAndPossessed.jpg')
                    ->setOrganiser($this->getReference(OrganiserFixture::organiser_reference))
                    ->setHall($this->getReference(HallFixture::hall_reference));

                    $concert->addBand($this->getReference(BandFixture::band_reference));
                    $concert->addFollower($this->getReference(FollowerFixture::follower_reference));

                    $manager->persist($concert);
        }

        for($i = 0; $i < 2; $i++) {
            $concert = new Concert();
            $concert->setName('Free 2022')
                ->setDateStart(\DateTime::createFromFormat('d-m-Y', '01-02-2022'))
                ->setDateEnd(\DateTime::createFromFormat('d-m-Y', '01-02-2022'))
                ->setLogo('free2022.jpg')
                ->setOrganiser($this->getReference(OrganiserFixture::organiser_reference))
                ->setHall($this->getReference(HallFixture::hall_reference));
        
                $concert->addBand($this->getReference(BandFixture::band_reference));
                $concert->addFollower($this->getReference(FollowerFixture::follower_reference));

                $manager->persist($concert);
        }


        $manager->flush();

        $this->addReference(self::concert_reference, $concert);
    }

    public function getDependencies()
    {
        return [
            OrganiserFixture::class,
            HallFixture::class,
        ];
    }
}