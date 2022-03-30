<?php

namespace App\Factory;

use App\Entity\Color;
use App\Repository\ColorRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Color>
 *
 * @method static Color|Proxy createOne(array $attributes = [])
 * @method static Color[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Color|Proxy find(object|array|mixed $criteria)
 * @method static Color|Proxy findOrCreate(array $attributes)
 * @method static Color|Proxy first(string $sortedField = 'id')
 * @method static Color|Proxy last(string $sortedField = 'id')
 * @method static Color|Proxy random(array $attributes = [])
 * @method static Color|Proxy randomOrCreate(array $attributes = [])
 * @method static Color[]|Proxy[] all()
 * @method static Color[]|Proxy[] findBy(array $attributes)
 * @method static Color[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Color[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ColorRepository|RepositoryProxy repository()
 * @method Color|Proxy create(array|callable $attributes = [])
 */
final class ColorFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
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
        return $this;
    }

    protected static function getClass(): string
    {
        return Color::class;
    }
}
