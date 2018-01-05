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
            ],
            'attributes' => [
            ],
        ]);
        $this->add([
            'type' => Element\Date::class,
            'name' => 'endedAt',
            'options' => [
                'label' => 'End date',
            ],
            'attributes' => [
            ],
        ]);

        $this->add([
            'type' => Element\Submit::class,
            'name' => 'submit',
            'attributes' => [
                'value' => 'Add a Meeting'
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
            'startedAt' => [
                'filters' => [
                    [
                        'name' => 'Zend\Filter\DatetimeFormatter',
                        'options' => [
                            'format' => 'Y-m-d',
                        ],
                    ]
                ]
            ],
            'endedAt' => [
                'filters' => [
                    [
                        'name' => 'Zend\Filter\DatetimeFormatter',
                        'options' => [
                            'format' => 'Y-m-d',
                        ],
                    ]
                ]
            ],
        ];
    }
}