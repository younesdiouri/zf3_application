<?php

declare(strict_types=1);

namespace Cinema\Repository;

use Meetup\Entity\Meetup;
use Doctrine\ORM\EntityRepository;

final class MeetupRepository extends EntityRepository
{

    public function add($Meetup) : void
    {
        $this->getEntityManager()->persist($Meetup);
        $this->getEntityManager()->flush($Meetup);
    }

    public function createMeetupFromNameAndDescription(string $name, string $description, \DateTimeImmutable $startedAt, \DateTimeImmutable $endedAt)
    {
        return new Meetup($name, $description, $startedAt, $endedAt);
    }
}
