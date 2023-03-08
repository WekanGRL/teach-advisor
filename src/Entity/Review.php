<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
#[UniqueEntity( fields: ['teacher','studentEmail'],
                message: "This student has already noted this teacher.",
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
    #[Assert\NotNull]
    private ?Teacher $teacher = null;

    public function __toString() : string
    {
        return sprintf('Review noted %s by %s', $this->note, $this->studentEmail);
    }

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

    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }

    public function setTeacher(?Teacher $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }

    #[ArrayShape(['id' => "int|null", 'note' => "int|null", 'comment' => "null|string", 'studentEmail' => "null|string", 'teacher' => "Teacher"])]
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
