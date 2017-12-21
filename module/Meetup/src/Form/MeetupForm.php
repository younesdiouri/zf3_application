<?php
declare(strict_types=1);
namespace Meetup\Form;
use Meetup\Entity\Meetup;
use Doctrine\ORM\EntityManager;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\StringLength;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
class MeetupForm extends Form implements InputFilterProviderInterface
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct('Meetup');
        $hydrator = new DoctrineHydrator($entityManager, Meetup::class);
        $this->setHydrator($hydrator);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'title',
            'options' => [
                'label' => 'Title',
            ],
        ]);
        $this->add([
            'type' => Element\Textarea::class,
            'name' => 'description',
            'options' => [
                'label' => 'Description',
            ],
        ]);
        $this->add([
            'type' => Element\Date::class,
            'name' => 'startedAt',
            'options' => [
                'label' => 'Start date',
                'format' => 'd-m-Y',
            ],
            'attributes' => [
                'min' => (new \DateTimeImmutable())->format('d-m-Y'),
                'max' => (new \DateTimeImmutable())->add(new \DateInterval('P4Y'))->format('d-m-Y'),
                'step' => '1', // days; default step interval is 1 day
            ],
        ]);
        $this->add([
            'type' => Element\Date::class,
            'name' => 'endedAt',
            'options' => [
                'label' => 'End date',
                'format' => 'd-m-Y',
            ],
            'attributes' => [
                'min' => (new \DateTimeImmutable())->format('d-m-Y'),
                'max' => (new \DateTimeImmutable())->add(new \DateInterval('P4Y'))->format('d-m-Y'),
                'step' => '1', // days; default step interval is 1 day
            ],
        ]);
    }
    public function getInputFilterSpecification()
    {
        return [
            'title' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 2,
                            'max' => 45,
                        ],
                    ],
                ],
            ],
        ];
    }
}