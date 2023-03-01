<?php

namespace App\Entity;

use App\Repository\SubjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\ArrayShape;

#[ORM\Entity(repositoryClass: SubjectRepository::class)]
class Subject implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\ManyToMany(targetEntity: Professor::class, mappedBy: 'subjects')]
    private Collection $professors;

    public function __construct()
    {
        $this->professors = new ArrayCollection();
    }

    public function __toString(): string
    {
        return sprintf('%s (%s)', $this->title, $this->reference);
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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return Collection<int, Professor>
     */
    public function getProfessors(): Collection
    {
        return $this->professors;
    }

    public function addProfessor(Professor $professor): self
    {
        if (!$this->professors->contains($professor)) {
            $this->professors->add($professor);
            $professor->addSubject($this);
        }

        return $this;
    }

    public function removeProfessor(Professor $professor): self
    {
        if ($this->professors->removeElement($professor)) {
            $professor->removeSubject($this);
        }

        return $this;
    }

    #[ArrayShape(['id' => "int|null", 'title' => "null|string", 'reference' => "null|string"])]
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'reference' => $this->reference,
        ];

    }
}
