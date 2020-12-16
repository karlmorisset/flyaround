<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use App\Entity\City;

class CityFixtures extends Fixture implements ContainerAwareInterface
{
    const LIMIT = 20;

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $serializer = $this->container->get('serializer');
        $filepath = realpath ("./") . "/src/DataFixtures/worldcities_dataset.csv";

        $data = $serializer->decode(file_get_contents($filepath), 'csv');

        for ($i=0; $i < count($data) && $i < self::LIMIT; $i++) {
            $line = $data[$i];
            $city = new City();
            $city->setName($line['city']);
            $city->setLatitude($line['lat']);
            $city->setLongitude($line['lng']);
            $city->setCountry($line['country']);
            $this->addReference('city_' . $i, $city);
            $manager->persist($city);
        }

        $manager->flush();
    }
}
