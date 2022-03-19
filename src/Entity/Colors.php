<?php

namespace App\Entity;

use App\Repository\ColorsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ColorsRepository::class)]
class Colors
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 2048)]
    private $value;

    #[ORM\Column(type: 'datetime')]
    private $created_at;

    #[ORM\Column(type: 'datetime')]
    private $updated_at;

    #[ORM\Column(type: 'string', length: 1024, nullable: true)]
    private $text;

    #[ORM\ManyToOne(targetEntity: user::class, inversedBy: 'colors')]
    #[ORM\JoinColumn(nullable: false)]
    private $user_id;

    #[ORM\OneToMany(mappedBy: 'color_id', targetEntity: ColorVisits::class)]
    private $colorVisits;

    public function __construct()
    {
        $this->colorVisits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getUserId(): ?user
    {
        return $this->user_id;
    }

    public function setUserId(?user $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return Collection<int, ColorVisits>
     */
    public function getColorVisits(): Collection
    {
        return $this->colorVisits;
    }

    public function addColorVisit(ColorVisits $colorVisit): self
    {
        if (!$this->colorVisits->contains($colorVisit)) {
            $this->colorVisits[] = $colorVisit;
            $colorVisit->setColorId($this);
        }

        return $this;
    }

    public function removeColorVisit(ColorVisits $colorVisit): self
    {
        if ($this->colorVisits->removeElement($colorVisit)) {
            // set the owning side to null (unless already changed)
            if ($colorVisit->getColorId() === $this) {
                $colorVisit->setColorId(null);
            }
        }

        return $this;
    }
}
