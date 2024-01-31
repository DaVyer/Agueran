<?php

namespace App\Factory;

use App\Entity\Utiliser;
use App\Repository\UtiliserRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Utiliser>
 *
 * @method        Utiliser|Proxy                     create(array|callable $attributes = [])
 * @method static Utiliser|Proxy                     createOne(array $attributes = [])
 * @method static Utiliser|Proxy                     find(object|array|mixed $criteria)
 * @method static Utiliser|Proxy                     findOrCreate(array $attributes)
 * @method static Utiliser|Proxy                     first(string $sortedField = 'id')
 * @method static Utiliser|Proxy                     last(string $sortedField = 'id')
 * @method static Utiliser|Proxy                     random(array $attributes = [])
 * @method static Utiliser|Proxy                     randomOrCreate(array $attributes = [])
 * @method static UtiliserRepository|RepositoryProxy repository()
 * @method static Utiliser[]|Proxy[]                 all()
 * @method static Utiliser[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Utiliser[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Utiliser[]|Proxy[]                 findBy(array $attributes)
 * @method static Utiliser[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Utiliser[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class UtiliserFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'Lieu' => self::faker()->text(100),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Utiliser $utiliser): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Utiliser::class;
    }
}
