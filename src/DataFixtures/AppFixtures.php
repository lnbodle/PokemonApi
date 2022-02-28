<?php

namespace App\DataFixtures;

use App\Entity\Pokemon;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 5; $i++) {
            $type = new Type();
            $type->setName('type '.$i);
            $manager->persist($type);
        }

        for ($i = 0; $i < 20; $i++) {
            $pokemon = new Pokemon();
            $pokemon->setName('pokemon '.$i);
            $pokemon->setDescription('A short description of the pokemon');
            $pokemon->addType($type);
            $manager->persist($pokemon);
        }

        

        $manager->flush();
    }
}
