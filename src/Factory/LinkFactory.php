<?php

namespace App\Factory;

use App\Entity\Link;
use App\Repository\LinkRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Link>
 *
 * @method static Link|Proxy createOne(array $attributes = [])
 * @method static Link[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Link|Proxy find(object|array|mixed $criteria)
 * @method static Link|Proxy findOrCreate(array $attributes)
 * @method static Link|Proxy first(string $sortedField = 'id')
 * @method static Link|Proxy last(string $sortedField = 'id')
 * @method static Link|Proxy random(array $attributes = [])
 * @method static Link|Proxy randomOrCreate(array $attributes = [])
 * @method static Link[]|Proxy[] all()
 * @method static Link[]|Proxy[] findBy(array $attributes)
 * @method static Link[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Link[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static LinkRepository|RepositoryProxy repository()
 * @method Link|Proxy create(array|callable $attributes = [])
 */
final class LinkFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->text(),
            'link' => self::faker()->url(),
            'created_at' => self::faker()->dateTime(),
            'updated_at' => self::faker()->dateTime(),
            'user' => UserFactory::new()
        ];
    }

    protected function initialize(): self
    {
        return $this;
    }

    protected static function getClass(): string
    {
        return Link::class;
    }
}
