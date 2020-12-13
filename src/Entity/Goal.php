<?php

namespace App\Entity;

use App\Repository\GoalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GoalRepository::class)
 */
class Goal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $colour;

    /**
     * @ORM\OneToMany(targetEntity=Step::class, mappedBy="goal", orphanRemoval=true)
     */
    private $step;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    public function __construct()
    {
        $this->step = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getColour(): ?string
    {
        return $this->colour;
    }

    public function setColour(string $colour): self
    {
        $this->colour = $colour;

        return $this;
    }

    /**
     * @return Collection|Step[]
     */
    public function getStep(): Collection
    {
        return $this->step;
    }

    public function addStep(Step $step): self
    {
        if (!$this->step->contains($step)) {
            $this->step[] = $step;
            $step->setGoal($this);
        }

        return $this;
    }

    public function removeStep(Step $step): self
    {
        if ($this->step->removeElement($step)) {
            // set the owning side to null (unless already changed)
            if ($step->getGoal() === $this) {
                $step->setGoal(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }
}
