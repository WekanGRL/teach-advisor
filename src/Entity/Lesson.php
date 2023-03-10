<?php

namespace App\Entity;

use App\Repository\LessonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LessonRepository::class)]
#[Assert\Expression(
    expression: 'this.checkDuration()',
    message: 'The lesson must last exactly one hour and a half.',
)]
class Lesson implements \JsonSerializable
{
    const TYPES = ['Tutorial', 'Practicum', 'Lecture', 'Exam'];
    const DURATION_HOURS = 1;
    const DURATION_MINUTES = 30;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank]
    #[Assert\Expression(
        expression: 'this.checkStartHour()',
        message: 'Lesson must start between 8 and 11 AM or between 2 and 5 PM.',
    )]
    private ?\DateTimeInterface $startDateTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank]
    #[Assert\GreaterThan(
        propertyPath: 'startDateTime',
        message: 'The start date must be before the end date.',
    )]
    private ?\DateTimeInterface $endDateTime = null;

    #[ORM\Column(length: 10)]
    #[Assert\NotBlank]
    #[Assert\ExpressionSyntax(
        message: 'The type must be one of the following: "Tutorial", "Practicum", "Lecture", "Exam".',
        allowedVariables: Lesson::TYPES,
    )]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'lessons')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull]
    private ?Room $room = null;

    #[ORM\ManyToOne(inversedBy: 'lessons')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull]
    #[Assert\Expression(
        expression: 'this.getSubject() in this.getTeacher().getSubjects().toArray()',
        message: 'The selected subject must be one of the teacher\'s.',
    )]
    private ?Subject $subject = null;

    #[ORM\ManyToOne(inversedBy: 'lessons')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull]
    private ?Teacher $teacher = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDateTime(): ?\DateTimeInterface
    {
        return $this->startDateTime;
    }

    public function setStartDateTime(\DateTimeInterface $startDateTime): self
    {
        $this->startDateTime = $startDateTime;

        return $this;
    }

    public function getEndDateTime(): ?\DateTimeInterface
    {
        return $this->endDateTime;
    }

    public function setEndDateTime(\DateTimeInterface $endDateTime): self
    {
        $this->endDateTime = $endDateTime;

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

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }

    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    public function setSubject(?Subject $subject): self
    {
        $this->subject = $subject;

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

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'startDateTime' => $this->startDateTime,
            'endDateTime' => $this->endDateTime,
            'type' => $this->type,
            'room' => $this->room,
            'subject' => $this->subject,
            'teacher' => $this->teacher,
        ];
    }

    public function checkDuration() : bool
    {
        $dateInterval = $this->endDateTime->diff($this->startDateTime);

        return (
            $dateInterval->y == 0 &&
            $dateInterval->m == 0 &&
            $dateInterval->d == 0 &&
            $dateInterval->h == Lesson::DURATION_HOURS &&
            $dateInterval->i == Lesson::DURATION_MINUTES
        );
    }

    public function checkStartHour() : bool
    {
        // Check before lunch
        $beforeLunch = $this->startDateTime->format('H') >= 8 && ($this->startDateTime->format('H') <= 11 && $this->startDateTime->format('i') == 0);

        // Check after lunch
        $afterLunch = $this->startDateTime->format('H') >= 14 && ($this->startDateTime->format('H') <= 17 && $this->startDateTime->format('i') == 0);

        return $beforeLunch || $afterLunch;
    }
}
