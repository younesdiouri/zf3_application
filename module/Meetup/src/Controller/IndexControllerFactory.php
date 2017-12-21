<?php

declare(strict_types=1);

namespace Cinema\Controller;

use Cinema\Entity\Meetup;
use Cinema\Form\FilmForm;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

final class IndexControllerFactory
{
    public function __invoke(ContainerInterface $container) : IndexController
    {
        $filmRepository = $container->get(EntityManager::class)->getRepository(Meetup::class);
        $filmForm = $container->get(FilmForm::class);

        return new IndexController($filmRepository, $filmForm);
    }
}
