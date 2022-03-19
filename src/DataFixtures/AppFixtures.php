<?php

namespace App\DataFixtures;

use App\Factory\ColorsFactory;
use App\Factory\LinksFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne(['email' => 'admin@admin.com', 'roles' => ['ROLE_ADMIN']]);

        UserFactory::createOne(['email' => 'admin@cum.com']);

        UserFactory::createMany(10);

        $links = LinksFactory::createMany(50, static function () {
            return [
                'user' => UserFactory::random()
            ];
        });

        $colors = ColorsFactory::createMany(50, static function () {
            return [
                'user' => UserFactory::random()
            ];
        });

        $manager->flush();
    }
}
