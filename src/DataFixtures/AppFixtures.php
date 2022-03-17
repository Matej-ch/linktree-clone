<?php

namespace App\DataFixtures;

use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne(['email' => 'admin@admin.com','roles' => ['ROLE_ADMIN']]);

        UserFactory::createOne(['email' => 'admin@cum.com']);

        UserFactory::createMany(10);

        $manager->flush();
    }
}
