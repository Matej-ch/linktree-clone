<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Scheb\TwoFactorBundle\Model\Totp\TotpConfiguration;
use Scheb\TwoFactorBundle\Model\Totp\TotpConfigurationInterface;
use Scheb\TwoFactorBundle\Model\Totp\TwoFactorInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
#[UniqueEntity(fields: ['name'], message: 'There is already an account with this name')]
class User implements UserInterface, PasswordAuthenticatedUserInterface, TwoFactorInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private string $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string', length: 255, unique: true, nullable: true)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    private ?string $plainPassword;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Link::class)]
    private $links;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Color::class)]
    private $colors;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column(name: 'totpSecret', type: 'string', nullable: true)]
    private ?string $totpSecret;

    #[ORM\Column(type: 'string', length: 255)]
    private string $backgroundColor = '#ffffff';

    #[ORM\Column(type: 'string', length: 255)]
    private string $textColor = '#000000';

    #[ORM\Column(type: 'string', length: 128, nullable: true)]
    private ?string $transitionFunction = 'ease';

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $transitionDuration = 0.75;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $textSize;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $borderSize;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $borderRadius;

    public function __construct()
    {
        $this->links = new ArrayCollection();
        $this->colors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = str_replace(' ', '_', $name);

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword(string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return Collection<int, Link>
     */
    public function getLinks(): Collection
    {
        return $this->links;
    }

    public function addLink(Link $link): self
    {
        if (!$this->links->contains($link)) {
            $this->links[] = $link;
            $link->setUser($this);
        }

        return $this;
    }

    public function removeLink(Link $link): self
    {
        if ($this->links->removeElement($link)) {
            // set the owning side to null (unless already changed)
            if ($link->getUser() === $this) {
                $link->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Color>
     */
    public function getColors(): Collection
    {
        return $this->colors;
    }

    public function addColor(Color $color): self
    {
        if (!$this->colors->contains($color)) {
            $this->colors[] = $color;
            $color->setUser($this);
        }

        return $this;
    }

    public function removeColor(Color $color): self
    {
        if ($this->colors->removeElement($color)) {
            // set the owning side to null (unless already changed)
            if ($color->getUser() === $this) {
                $color->setUser(null);
            }
        }

        return $this;
    }

    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function isTotpAuthenticationEnabled(): bool
    {
        return $this->totpSecret ? true : false;
    }

    public function getTotpAuthenticationUsername(): string
    {
        return $this->getUserIdentifier();
    }

    public function getTotpAuthenticationConfiguration(): ?TotpConfigurationInterface
    {
        return new TotpConfiguration($this->totpSecret, TotpConfiguration::ALGORITHM_SHA1, 30, 6);
    }

    /**
     * @param string|null $totpSecret
     * @return User
     */
    public function setTotpSecret(?string $totpSecret): self
    {
        $this->totpSecret = $totpSecret;

        return $this;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->backgroundColor;
    }

    public function setBackgroundColor(string $backgroundColor): self
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
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

    public function getTransitionFunction(): ?string
    {
        return $this->transitionFunction;
    }

    public function setTransitionFunction(?string $transitionFunction): self
    {
        $this->transitionFunction = $transitionFunction;

        return $this;
    }

    public function getTransitionDuration(): ?float
    {
        return $this->transitionDuration;
    }

    public function setTransitionDuration(?float $transitionDuration): self
    {
        $this->transitionDuration = $transitionDuration;

        return $this;
    }

    public function getTextSize(): ?string
    {
        return $this->textSize;
    }

    public function setTextSize(?string $textSize): self
    {
        $this->textSize = $textSize;

        return $this;
    }

    public function getBorderSize(): ?string
    {
        return $this->borderSize;
    }

    public function setBorderSize(?string $borderSize): self
    {
        $this->borderSize = $borderSize;

        return $this;
    }

    public function getBorderRadius(): ?string
    {
        return $this->borderRadius;
    }

    public function setBorderRadius(?string $borderRadius): self
    {
        $this->borderRadius = $borderRadius;

        return $this;
    }
}
