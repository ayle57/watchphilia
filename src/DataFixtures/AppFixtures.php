<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\Section;
use App\Entity\SubSection;
use App\Entity\User;
use App\Entity\Watch;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 50; $i++) {
            $property = new Property();
            $property->setName("Property $i");
            $manager->persist($property);
            $this->addReference("property$i", $property);
        }

        for ($i = 1; $i <= 10; $i++) {
            $section = new Section();
            $section->setName("Section $i");
            $manager->persist($section);
            $this->addReference("section$i", $section);
        }

        for ($i = 1; $i <= 20; $i++) {
            $subsection = new SubSection();
            $subsection->setName("SubSection $i");
            $manager->persist($subsection);
            $this->addReference("subsection$i", $subsection);
        }

        for ($i = 1; $i <= 30; $i++) {
            $user = new User();
            $user->setUsername("user$i");
            $user->setEmail("user$i@example.com");
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->passwordEncoder->hashPassword($user, 'password'));
            $manager->persist($user);
            $this->addReference("user$i", $user);
        }

        for ($i = 1; $i <= 100; $i++) {
            $watch = new Watch();
            $watch->setName("Watch $i");
            $watch->setDescription("Description for Watch $i");
            $watch->setPrice(rand(50, 1000));
            $watch->setImageUrl('https://picsum.photos/400');
            $watch->setSubsection($this->getReference("subsection" . rand(1, 20)));
            $watch->setSection($this->getReference("section" . rand(1, 10)));

            $properties = $this->getRandomProperties(5);
            foreach ($properties as $property) {
                $watch->addProperty($property);
            }

            $manager->persist($watch);
        }

        $manager->flush();
    }

    private function getRandomProperties(int $count): array
    {
        $properties = [];
        $propertyIds = range(1, 50);
        shuffle($propertyIds);
        $selectedPropertyIds = array_slice($propertyIds, 0, $count); // Select the required number of properties
        foreach ($selectedPropertyIds as $propertyId) {
            $properties[] = $this->getReference("property$propertyId");
        }
        return $properties;
    }

    public function getDependencies()
    {
        return [
            Property::class,
            Section::class,
            SubSection::class,
        ];
    }
}
