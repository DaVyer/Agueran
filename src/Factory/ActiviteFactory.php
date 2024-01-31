<?php

namespace App\Factory;

use App\Entity\Activite;
use App\Repository\ActiviteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Activite>
 *
 * @method        Activite|Proxy                     create(array|callable $attributes = [])
 * @method static Activite|Proxy                     createOne(array $attributes = [])
 * @method static Activite|Proxy                     find(object|array|mixed $criteria)
 * @method static Activite|Proxy                     findOrCreate(array $attributes)
 * @method static Activite|Proxy                     first(string $sortedField = 'id')
 * @method static Activite|Proxy                     last(string $sortedField = 'id')
 * @method static Activite|Proxy                     random(array $attributes = [])
 * @method static Activite|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ActiviteRepository|RepositoryProxy repository()
 * @method static Activite[]|Proxy[]                 all()
 * @method static Activite[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Activite[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Activite[]|Proxy[]                 findBy(array $attributes)
 * @method static Activite[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Activite[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ActiviteFactory extends ModelFactory
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
            'dateActivite' => self::faker()->dateTime(),
            'estActiviteAnimal' => self::faker()->boolean(),
            'heureDebutActivite' => self::faker()->dateTime(),
            'heureFinActivite' => self::faker()->dateTime(),
            'libActivite' => self::faker()->text(150),
            'nbVisiteurMaxActivite' => self::faker()->randomNumber(strict: true),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Activite $activite): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Activite::class;
    }
}
