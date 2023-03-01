<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
#[UniqueEntity( fields: ['professor','studentEmail'],
                message: "This student has already noted this professor.",
                errorPath: "studentEmail")]

class Review implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\NotBlank]
    #[Assert\Range(min:0, max:5)]
    private ?int $note = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    private ?string $comment = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $studentEmail = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Professor $professor = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getStudentEmail(): ?string
    {
        return $this->studentEmail;
    }

    public function setStudentEmail(string $studentEmail): self
    {
        $this->studentEmail = $studentEmail;

        return $this;
    }

    public function getProfessor(): ?Professor
    {
        return $this->professor;
    }

    public function setProfessor(?Professor $professor): self
    {
        $this->professor = $professor;

        return $this;
    }

    #[ArrayShape(['id' => "int|null", 'note' => "int|null", 'comment' => "null|string", 'studentEmail' => "null|string", 'professor' => "Professor"])]
    public function jsonSerialize() : array
    {
        return [
            'id'            => $this->id,
            'note'          => $this->note,
            'comment'       => $this->comment,
            'studentEmail'  => $this->studentEmail,
        ];
    }

    public function fromArray(array $data) : self
    {
        $this->note = $data['note'] ?? $this->note;
        $this->comment = $data['comment'] ?? $this->comment;
        $this->studentEmail = $data['studentEmail'] ?? $this->studentEmail;

        return $this;
    }
}
