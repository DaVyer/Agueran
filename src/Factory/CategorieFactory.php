<?php

namespace App\Factory;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Categorie>
 *
 * @method        Categorie|Proxy                     create(array|callable $attributes = [])
 * @method static Categorie|Proxy                     createOne(array $attributes = [])
 * @method static Categorie|Proxy                     find(object|array|mixed $criteria)
 * @method static Categorie|Proxy                     findOrCreate(array $attributes)
 * @method static Categorie|Proxy                     first(string $sortedField = 'id')
 * @method static Categorie|Proxy                     last(string $sortedField = 'id')
 * @method static Categorie|Proxy                     random(array $attributes = [])
 * @method static Categorie|Proxy                     randomOrCreate(array $attributes = [])
 * @method static CategorieRepository|RepositoryProxy repository()
 * @method static Categorie[]|Proxy[]                 all()
 * @method static Categorie[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Categorie[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Categorie[]|Proxy[]                 findBy(array $attributes)
 * @method static Categorie[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Categorie[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class CategorieFactory extends ModelFactory
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
            'nomCategorie' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Categorie $categorie): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Categorie::class;
    }
}
