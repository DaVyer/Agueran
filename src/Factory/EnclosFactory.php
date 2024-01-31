<?php

namespace App\Factory;

use App\Entity\Enclos;
use App\Repository\EnclosRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Enclos>
 *
 * @method        Enclos|Proxy                     create(array|callable $attributes = [])
 * @method static Enclos|Proxy                     createOne(array $attributes = [])
 * @method static Enclos|Proxy                     find(object|array|mixed $criteria)
 * @method static Enclos|Proxy                     findOrCreate(array $attributes)
 * @method static Enclos|Proxy                     first(string $sortedField = 'id')
 * @method static Enclos|Proxy                     last(string $sortedField = 'id')
 * @method static Enclos|Proxy                     random(array $attributes = [])
 * @method static Enclos|Proxy                     randomOrCreate(array $attributes = [])
 * @method static EnclosRepository|RepositoryProxy repository()
 * @method static Enclos[]|Proxy[]                 all()
 * @method static Enclos[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Enclos[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Enclos[]|Proxy[]                 findBy(array $attributes)
 * @method static Enclos[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Enclos[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class EnclosFactory extends ModelFactory
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
        $nomEnclos = mb_convert_case(self::faker()->word(), MB_CASE_TITLE);
        $descEnclos = self::faker()->text();

        return [
            'nomEnclos' => $nomEnclos,
            'descEnclos' => $descEnclos,
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Enclos $enclos): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Enclos::class;
    }
}
