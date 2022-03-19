<?php

namespace App\Entity;

use App\Repository\LinkVisitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LinkVisitRepository::class)]
class LinkVisit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $created_at;

    #[ORM\Column(type: 'datetime')]
    private $updated_at;

    #[ORM\Column(type: 'string', length: 2048, nullable: true)]
    private $user_agent;

    #[ORM\ManyToOne(targetEntity: Link::class, inversedBy: 'linkVisits')]
    #[ORM\JoinColumn(nullable: false)]
    private $link_id;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUserAgent(): ?string
    {
        return $this->user_agent;
    }

    public function setUserAgent(?string $user_agent): self
    {
        $this->user_agent = $user_agent;

        return $this;
    }

    public function getLinkId(): ?Link
    {
        return $this->link_id;
    }

    public function setLinkId(?Link $link_id): self
    {
        $this->link_id = $link_id;

        return $this;
    }
}
