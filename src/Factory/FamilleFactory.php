<?php

namespace App\Factory;

use App\Entity\Famille;
use App\Repository\FamilleRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Famille>
 *
 * @method        Famille|Proxy                     create(array|callable $attributes = [])
 * @method static Famille|Proxy                     createOne(array $attributes = [])
 * @method static Famille|Proxy                     find(object|array|mixed $criteria)
 * @method static Famille|Proxy                     findOrCreate(array $attributes)
 * @method static Famille|Proxy                     first(string $sortedField = 'id')
 * @method static Famille|Proxy                     last(string $sortedField = 'id')
 * @method static Famille|Proxy                     random(array $attributes = [])
 * @method static Famille|Proxy                     randomOrCreate(array $attributes = [])
 * @method static FamilleRepository|RepositoryProxy repository()
 * @method static Famille[]|Proxy[]                 all()
 * @method static Famille[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Famille[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Famille[]|Proxy[]                 findBy(array $attributes)
 * @method static Famille[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Famille[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class FamilleFactory extends ModelFactory
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
            'nomFamille' => self::faker()->text(100),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Famille $famille): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Famille::class;
    }
}
