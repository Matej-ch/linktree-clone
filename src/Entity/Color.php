<?php

namespace App\Entity;

use App\Repository\ColorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;
use Doctrine\Persistence\Event\LifecycleEventArgs;

#[ORM\Entity(repositoryClass: ColorRepository::class)]
#[HasLifecycleCallbacks]
class Color
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 2048)]
    private $value;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private $created_at;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private $updated_at;

    #[ORM\Column(type: 'string', length: 1024, nullable: true)]
    private $text;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'colors')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\OneToMany(mappedBy: 'color', targetEntity: ColorVisit::class, cascade: ["remove"])]
    #[ORM\OrderBy(["created_at" => "DESC"])]
    private $colorVisits;

    #[ORM\Column(type: 'string', length: 512)]
    private $textColor;

    #[ORM\Column(type: 'string', length: 512)]
    private $nameColor;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
     * @return Collection<int, ColorVisit>
     */
    public function getColorVisits(): Collection
    {
        return $this->colorVisits;
    }

    public function getLatestVisit()
    {
        return $this->getColorVisits()->first();
    }

    public function addColorVisit(ColorVisit $colorVisit): self
    {
        if (!$this->colorVisits->contains($colorVisit)) {
            $this->colorVisits[] = $colorVisit;
            $colorVisit->setColor($this);
        }

        return $this;
    }

    public function removeColorVisit(ColorVisit $colorVisit): self
    {
        if ($this->colorVisits->removeElement($colorVisit)) {
            // set the owning side to null (unless already changed)
            if ($colorVisit->getColor() === $this) {
                $colorVisit->setColor(null);
            }
        }

        return $this;
    }

    #[PrePersist]
    public function setTimestamps(LifecycleEventArgs $eventArgs)
    {
        $this->created_at = new \DateTime(date('Y-m-d H:i:s'));
        $this->updated_at = new \DateTime(date('Y-m-d H:i:s'));
    }

    #[PreUpdate]
    public function updateTimestamps(\Doctrine\ORM\Event\PreUpdateEventArgs $eventArgs)
    {
        $this->updated_at = new \DateTime(date('Y-m-d H:i:s'));
    }

    public function getTextColor(): ?string
    {
        return $this->textColor;
    }

    public function setTextColor(string $textColor): self
    {
        $this->textColor = $textColor;

        return $this;
    }

    public function getNameColor(): ?string
    {
        return $this->nameColor;
    }

    public function setNameColor(string $nameColor): self
    {
        $this->nameColor = $nameColor;

        return $this;
    }
}
