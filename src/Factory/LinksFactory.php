<?php

namespace App\Factory;

use App\Entity\Links;
use App\Repository\LinksRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Links>
 *
 * @method static Links|Proxy createOne(array $attributes = [])
 * @method static Links[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Links|Proxy find(object|array|mixed $criteria)
 * @method static Links|Proxy findOrCreate(array $attributes)
 * @method static Links|Proxy first(string $sortedField = 'id')
 * @method static Links|Proxy last(string $sortedField = 'id')
 * @method static Links|Proxy random(array $attributes = [])
 * @method static Links|Proxy randomOrCreate(array $attributes = [])
 * @method static Links[]|Proxy[] all()
 * @method static Links[]|Proxy[] findBy(array $attributes)
 * @method static Links[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Links[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static LinksRepository|RepositoryProxy repository()
 * @method Links|Proxy create(array|callable $attributes = [])
 */
final class LinksFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'name' => self::faker()->text(),
            'link' => self::faker()->url(),
            'created_at' => self::faker()->dateTime(),
            'updated_at' => self::faker()->dateTime(),
            'user' => UserFactory::new()
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Links $links): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Links::class;
    }
}
