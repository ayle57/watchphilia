<?php

namespace App\Entity;

use App\Repository\SectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SectionRepository::class)]
class Section
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $min_price = null;

    #[ORM\Column(nullable: true)]
    private ?int $exact_price = null;

    #[ORM\Column(nullable: true)]
    private ?int $max_price = null;

    #[ORM\OneToMany(targetEntity: Watch::class, mappedBy: 'section')]
    private Collection $watches;

    public function __construct()
    {
        $this->watches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getMinPrice(): ?int
    {
        return $this->min_price;
    }

    public function setMinPrice(?int $min_price): static
    {
        $this->min_price = $min_price;

        return $this;
    }

    public function getExactPrice(): ?int
    {
        return $this->exact_price;
    }

    public function setExactPrice(?int $exact_price): static
    {
        $this->exact_price = $exact_price;

        return $this;
    }

    public function getMaxPrice(): ?int
    {
        return $this->max_price;
    }

    public function setMaxPrice(?int $max_price): static
    {
        $this->max_price = $max_price;

        return $this;
    }

    /**
     * @return Collection<int, Watch>
     */
    public function getWatches(): Collection
    {
        return $this->watches;
    }

    public function addWatch(Watch $watch): static
    {
        if (!$this->watches->contains($watch)) {
            $this->watches->add($watch);
            $watch->setSection($this);
        }

        return $this;
    }

    public function removeWatch(Watch $watch): static
    {
        if ($this->watches->removeElement($watch)) {
            // set the owning side to null (unless already changed)
            if ($watch->getSection() === $this) {
                $watch->setSection(null);
            }
        }

        return $this;
    }
}
