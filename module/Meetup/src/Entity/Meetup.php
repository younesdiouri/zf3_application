<?php

declare(strict_types=1);

namespace Meetup\Entity;

use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Meetup
 * @package Meetup\Entity
 * @ORM\Entity(repositoryClass="\Meetup\Repository\MeetupRepository")
 * @ORM\Table(name="meetups")
 */
class Meetup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     **/
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=2000, nullable=false)
     */
    private $description = '';

    /**
     * @ORM\Column(type="datetime", name="started_at", nullable=false)
     */
    private $startedAt;

    /**
     * @ORM\Column(type="datetime", name="ended_at", nullable=false)
     */
    private $endedAt;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }
    public function setTitle(string $title) :void
    {
        $this->title = $title;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    public function getStartedAt() : \DateTime
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTime $startedAt) : void
    {
        $this->startedAt = $startedAt;
    }

    public function getEndedAt() : \DateTime
    {
        return $this->endedAt;
    }

    public function setEndedAt(\DateTime $endedAt) : void
    {
        $this->endedAt = $endedAt;
    }
}
