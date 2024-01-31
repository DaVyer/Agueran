<?php

namespace App\DataFixtures;

use App\Factory\AnimalsFactory;
use App\Factory\CategorieFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;

class AnimalsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $dir = __DIR__;

        AnimalsFactory::createSequence(
            [
                [
                    'nomAnimal' => 'Panda roux',
                    'lieuOriginaireAnimal' => 'Asie',
                    'descAnimal' => "Le panda roux, appelé aussi petit panda ou panda rouge est un mammifère omnivore natif de l'Himalaya d'Asie du Sud et du Sud-Est. Il est appelé renard de feu en Chine.",
                    'image' => $this->getImage("{$dir}/data/animals/ID-00077.JPG"),
                    'categorie' => CategorieFactory::find(['id' => 1]),
                ],
                [
                    'nomAnimal' => 'Otarie de Californie',
                    'lieuOriginaireAnimal' => 'Amérique du Nord',
                    'descAnimal' => "L'Otarie de Californie est une grosse otarie, qu'on peut voir notamment dans le port de San Francisco. Elle est en particulier largement utilisée dans les programmes éducatifs, dans les zoos, cirques et parcs d’attractions aquatiques, pour ses capacités de dressage et son agilité.",
                    'image' => $this->getImage("{$dir}/data/animals/ID-05235.JPG"),
                    'categorie' => CategorieFactory::find(['id' => 1]),
                ],
                [
                    'nomAnimal' => 'Loutre cendrée',
                    'lieuOriginaireAnimal' => 'Asie du Sud-Est',
                    'descAnimal' => "La loutre cendrée est une espèce de loutres de la famille des Mustelidés. Aussi appelée loutre asiatique, loutre naine d'Asie ou loutre à griffes courtes, cette loutre est menacée et considérée comme étant vulnérable à cause de la disparition rapide de son habitat et de la pollution aux pesticides.",
                    'image' => $this->getImage("{$dir}/data/animals/ID-00078.JPG"),
                    'categorie' => CategorieFactory::find(['id' => 1]),
                ],
                [
                    'nomAnimal' => 'Panthère des neiges',
                    'lieuOriginaireAnimal' => 'Asie centrale',
                    'descAnimal' => 'La Panthère des neiges, aussi appelée Léopard des neiges, Once ou Irbis, est une espèce de félins de la sous-famille des Pantherinae. Historiquement classée dans le genre monotypique Uncia, elle fait à présent partie du genre Panthera.',
                    'image' => $this->getImage("{$dir}/data/animals/ID-00118.JPG"),
                    'categorie' => CategorieFactory::find(['id' => 1]),
                ],
                [
                    'nomAnimal' => 'Pygargue à tête blanche',
                    'lieuOriginaireAnimal' => 'Amérique du Nord',
                    'descAnimal' => 'Le Pygargue à tête blanche est un très gros oiseau. Ses ailes, bien adaptées au vol plané, sont larges et longues, leur envergure atteignant plus de 2 m.',
                    'image' => $this->getImage("{$dir}/data/animals/ID-00440.JPG"),
                    'categorie' => CategorieFactory::find(['id' => 2]),
                ],
                [
                    'nomAnimal' => 'Pygargue empereur',
                    'lieuOriginaireAnimal' => 'Asie centrale',
                    'descAnimal' => "Le pygargue empereur est l'un des plus grands rapaces connus, avec la harpie féroce : il pèse 8 kg en moyenne. Piscivore, il mange principalement du saumon, mais la force de ses pattes et de son bec lui permet de tuer des proies comme un renard polaire ou un petit phoque.",
                    'image' => $this->getImage("{$dir}/data/animals/ID-00445.JPG"),
                    'categorie' => CategorieFactory::find(['id' => 2]),
                ],
            ]
        );
    }

    public function getImage(string $path): string
    {
        $file = new File($path);

        return file_get_contents($file->getPathname());
    }

    public function getDependencies(): array
    {
        return [CategorieFixtures::class];
    }
}
