<?php

namespace App\DataFixtures;

use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\Category;
use Faker;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var Slugify
     */
    private $slugify;
    /**
     * ArticleFixtures constructor.
     * @param Slugify $slugify
     */
    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        // on créé 10 personnes
        for ($i = 0; $i < 50; $i++) {
            $article = new Article();
            $article->setTitle(mb_strtolower($faker->sentence()));
            $article->setContent($faker->text);
            $article->setCategory($this->getReference('categorie_' . rand(0,4)));
            $article->setSlug($this->slugify->generate($article->getTitle()));
            $manager->persist($article);
        }

        $manager->flush();
    }

}

