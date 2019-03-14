<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ElementRepository")
 */
class Element
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
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
    private $type;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $priority;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $estimation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Backlog", inversedBy="elements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $backlog;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $listeCheck;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $criteresTests;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="elements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(?int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getEstimation(): ?int
    {
        return $this->estimation;
    }

    public function setEstimation(?int $estimation): self
    {
        $this->estimation = $estimation;

        return $this;
    }

    public function getBacklog(): ?Backlog
    {
        return $this->backlog;
    }

    public function setBacklog(?Backlog $backlog): self
    {
        $this->backlog = $backlog;

        return $this;
    }

    public function getListeCheck(): ?string
    {
        return $this->listeCheck;
    }

    public function setListeCheck(?string $listeCheck): self
    {
        $this->listeCheck = $listeCheck;

        return $this;
    }

    public function getCriteresTests(): ?string
    {
        return $this->criteresTests;
    }

    public function setCriteresTests(?string $criteresTests): self
    {
        $this->criteresTests = $criteresTests;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
