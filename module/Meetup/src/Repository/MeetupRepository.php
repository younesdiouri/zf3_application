<?php

declare(strict_types=1);

namespace Meetup\Repository;

use Meetup\Entity\Meetup;
use Doctrine\ORM\EntityRepository;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

final class MeetupRepository extends EntityRepository
{

    public function add($Meetup) : void
    {

        $createMeetup = new Meetup();
        /** @var DoctrineHydrator $hydrator */
        $hydrator = new DoctrineHydrator($this->getEntityManager());
        $hydrator->hydrate($Meetup, $createMeetup);
        $this->getEntityManager()->persist($createMeetup);
        $this->getEntityManager()->flush($createMeetup);
    }
}
