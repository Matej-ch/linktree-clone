<?php

namespace App\Factory;

use App\Entity\Colors;
use App\Repository\ColorsRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Colors>
 *
 * @method static Colors|Proxy createOne(array $attributes = [])
 * @method static Colors[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Colors|Proxy find(object|array|mixed $criteria)
 * @method static Colors|Proxy findOrCreate(array $attributes)
 * @method static Colors|Proxy first(string $sortedField = 'id')
 * @method static Colors|Proxy last(string $sortedField = 'id')
 * @method static Colors|Proxy random(array $attributes = [])
 * @method static Colors|Proxy randomOrCreate(array $attributes = [])
 * @method static Colors[]|Proxy[] all()
 * @method static Colors[]|Proxy[] findBy(array $attributes)
 * @method static Colors[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Colors[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ColorsRepository|RepositoryProxy repository()
 * @method Colors|Proxy create(array|callable $attributes = [])
 */
final class ColorsFactory extends ModelFactory
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
            'value' => self::faker()->hexColor(),
            'text' => self::faker()->text(),
            'created_at' => self::faker()->dateTime(),
            'updated_at' => self::faker()->dateTime(),
            'user' => UserFactory::new()
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Colors $colors): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Colors::class;
    }
}
