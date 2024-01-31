<?php

namespace App\Factory;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Animal>
 *
 * @method        Animal|Proxy                     create(array|callable $attributes = [])
 * @method static Animal|Proxy                     createOne(array $attributes = [])
 * @method static Animal|Proxy                     find(object|array|mixed $criteria)
 * @method static Animal|Proxy                     findOrCreate(array $attributes)
 * @method static Animal|Proxy                     first(string $sortedField = 'id')
 * @method static Animal|Proxy                     last(string $sortedField = 'id')
 * @method static Animal|Proxy                     random(array $attributes = [])
 * @method static Animal|Proxy                     randomOrCreate(array $attributes = [])
 * @method static AnimalRepository|RepositoryProxy repository()
 * @method static Animal[]|Proxy[]                 all()
 * @method static Animal[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Animal[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Animal[]|Proxy[]                 findBy(array $attributes)
 * @method static Animal[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Animal[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class AnimalsFactory extends ModelFactory
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
            'enclos' => EnclosFactory::new(),
            'famille' => FamilleFactory::new(),
            'lieuOriginaireAnimal' => self::faker()->text(150),
            'nomAnimal' => self::faker()->text(150),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Animal $animal): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Animal::class;
    }
}
