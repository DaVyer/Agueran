<?php

namespace App\Factory;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<User>
 *
 * @method        User|Proxy                     create(array|callable $attributes = [])
 * @method static User|Proxy                     createOne(array $attributes = [])
 * @method static User|Proxy                     find(object|array|mixed $criteria)
 * @method static User|Proxy                     findOrCreate(array $attributes)
 * @method static User|Proxy                     first(string $sortedField = 'id')
 * @method static User|Proxy                     last(string $sortedField = 'id')
 * @method static User|Proxy                     random(array $attributes = [])
 * @method static User|Proxy                     randomOrCreate(array $attributes = [])
 * @method static UserRepository|RepositoryProxy repository()
 * @method static User[]|Proxy[]                 all()
 * @method static User[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static User[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static User[]|Proxy[]                 findBy(array $attributes)
 * @method static User[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static User[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class UserFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    private $passwordHasher;
    private $transliterator;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();

        $this->passwordHasher = $passwordHasher;

        $this->transliterator = transliterator_create('Any-Latin; Latin-ASCII');
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        $prenom = self::faker()->firstName();
        $nom = self::faker()->lastName();
        $phone = self::faker()->phoneNumber();
        $adresse = self::faker()->streetAddress();
        $ville = self::faker()->city();
        $codePostal = self::faker()->postcode();
        $pays = self::faker()->countryCode();

        return [
            'adresse' => $adresse,
            'ville' => $ville,
            'codePostal' => str_replace(' ', '', $codePostal),
            'pays' => $pays,
            'email' => $this->normalizeName(mb_strtolower($nom)).'@'.self::faker()->domainName(),
            'nom' => $nom,
            'password' => 'azerty01',
            'prenom' => $prenom,
            'roles' => ['ROLE_USER'],
            'telephone' => $phone,
        ];
    }

    protected function normalizeName(string $string): string
    {
        return preg_replace('[^a-zA-Z0-9_ ]', '-', transliterator_transliterate($this->transliterator, $string));
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            ->afterInstantiate(function (User $user) {
                $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));
            })
        ;
    }

    protected static function getClass(): string
    {
        return User::class;
    }
}
