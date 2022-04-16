<?php

namespace App\Entity;

use App\Repository\LinkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;
use Doctrine\Persistence\Event\LifecycleEventArgs;

#[ORM\Entity(repositoryClass: LinkRepository::class)]
#[HasLifecycleCallbacks]
class Link
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 1024)]
    private $link;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private $created_at;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private $updated_at;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'links')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\OneToMany(mappedBy: 'link', targetEntity: LinkVisit::class)]
    #[ORM\OrderBy(["created_at" => "DESC"])]
    private $linkVisits;

    #[ORM\Column(type: 'string', length: 512, nullable: true)]
    private $textColor;

    public function __construct()
    {
        $this->linkVisits = new ArrayCollection();
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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, LinkVisit>
     */
    public function getLinkVisits(): Collection
    {
        return $this->linkVisits;
    }

    public function getLatestVisit()
    {
        return $this->getLinkVisits()->first();
    }

    public function addLinkVisit(LinkVisit $linkVisit): self
    {
        if (!$this->linkVisits->contains($linkVisit)) {
            $this->linkVisits[] = $linkVisit;
            $linkVisit->setLink($this);
        }

        return $this;
    }

    public function removeLinkVisit(LinkVisit $linkVisit): self
    {
        if ($this->linkVisits->removeElement($linkVisit)) {
            // set the owning side to null (unless already changed)
            if ($linkVisit->getLink() === $this) {
                $linkVisit->setLink(null);
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
    public function updateTimestamps(PreUpdateEventArgs $eventArgs)
    {
        $this->updated_at = new \DateTime(date('Y-m-d H:i:s'));
    }

    public function getTextColor(): ?string
    {
        return $this->textColor;
    }

    public function setTextColor(?string $textColor): self
    {
        $this->textColor = $textColor;

        return $this;
    }
}
