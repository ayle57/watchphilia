<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\Section;
use App\Entity\SubSection;
use App\Entity\Watch;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $properties = [];
        for ($i = 1; $i <= 10; $i++) {
            $property = new Property();
            $property->setName("Property $i");
            $manager->persist($property);
            $properties[] = $property;
        }

        $sections = [];
        for ($i = 1; $i <= 5; $i++) {
            $section = new Section();
            $section->setName("Section $i");
            $manager->persist($section);
            $sections[] = $section;
        }

        $subsections = [];
        for ($i = 1; $i <= 5; $i++) {
            $subsection = new SubSection();
            $subsection->setName("SubSection $i");
            $manager->persist($subsection);
            $subsections[] = $subsection;
        }

        foreach ($sections as $section) {
            $subsectionsInSection = array_filter($subsections, function($subsection) use ($section) {
                return $subsection->getSection() === $section;
            });

            foreach ($subsectionsInSection as $subsection) {
                $watches = [];
                for ($i = 1; $i <= 20; $i++) {
                    $watch = new Watch();
                    $watch->setName("Watch $i for {$section->getName()} - {$subsection->getName()}");
                    $watch->setDescription("Description of Watch $i");
                    $watch->setPrice(rand(100, 10000));
                    $watch->setSection($section);
                    $watch->setSubsection($subsection);
                    $watches[] = $watch;

                    $numberOfProperties = rand(1, 3);
                    $watchProperties = [];
                    for ($j = 0; $j < $numberOfProperties; $j++) {
                        $property = $properties[rand(0, 9)];
                        $watchProperties[] = $property;
                        $watch->addProperty($property);
                    }

                    $manager->persist($watch);
                }
            }
        }


        $manager->flush();
    }
}
