<?php

namespace App\Factory;

use App\Entity\Reserver;
use App\Repository\ReserverRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Reserver>
 *
 * @method        Reserver|Proxy                     create(array|callable $attributes = [])
 * @method static Reserver|Proxy                     createOne(array $attributes = [])
 * @method static Reserver|Proxy                     find(object|array|mixed $criteria)
 * @method static Reserver|Proxy                     findOrCreate(array $attributes)
 * @method static Reserver|Proxy                     first(string $sortedField = 'id')
 * @method static Reserver|Proxy                     last(string $sortedField = 'id')
 * @method static Reserver|Proxy                     random(array $attributes = [])
 * @method static Reserver|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ReserverRepository|RepositoryProxy repository()
 * @method static Reserver[]|Proxy[]                 all()
 * @method static Reserver[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Reserver[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Reserver[]|Proxy[]                 findBy(array $attributes)
 * @method static Reserver[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Reserver[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ReserverFactory extends ModelFactory
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
            'activite' => ActiviteFactory::random(),
            'dateReservation' => self::faker()->dateTime(),
            'nbVisiteurs' => self::faker()->randomNumber(
                $nbDigits = 2,
                $strict = false
            ),
            'user' => UserFactory::random(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
        ;
    }

    protected static function getClass(): string
    {
        return Reserver::class;
    }
}
