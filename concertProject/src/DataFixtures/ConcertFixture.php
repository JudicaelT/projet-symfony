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
        $concert = new Concert();
        $concert->setName('Hellfest')
                ->setDateStart(\DateTime::createFromFormat('d-m-Y', '10-12-2022'))
                ->setDateEnd(\DateTime::createFromFormat('d-m-Y', '10-12-2022'))
                ->setLogo('img/testImg.jpg')
                ->setOrganiser($this->getReference(OrganiserFixture::organiser_reference))
                ->setHall($this->getReference(HallFixture::hall_reference));

        $manager->persist($concert);
        $manager->flush();

        $this->addReference(self::concert_reference, $concert);
        $concert->addBand($this->getReference(BandFixture::band_reference));
        $concert->addFollower($this->getReference(FollowerFixture::follower_reference));
    }

    public function getDependencies()
    {
        return [
            OrganiserFixture::class,
            HallFixture::class,
        ];
    }
}