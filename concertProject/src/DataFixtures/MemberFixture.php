<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\BandFixture;
use App\Entity\Member;

class MemberFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $member = new Member();
        $member->setFirstName('David')
               ->setLastName('Bowie')
               ->setRole('Singer')
               ->setBand($this->getReference(BandFixture::band_reference));

        $manager->persist($member);
        $manager->flush();
    }
}