<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Meetup\Entity\Meetup;
use Meetup\Repository\MeetupRepository;
use Meetup\Form\MeetupForm;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

final class IndexController extends AbstractActionController
{
    /**
     * @var MeetupRepository
     */
    private $MeetupRepository;

    /**
     * @var MeetupForm
     */
    private $MeetupForm;

    public function __construct(MeetupRepository $MeetupRepository, MeetupForm $MeetupForm)
    {
        $this->MeetupRepository = $MeetupRepository;
        $this->MeetupForm = $MeetupForm;
    }

    public function indexAction()
    {
        return new ViewModel([
            'Meetups' => $this->MeetupRepository->findAll(),
        ]);
    }

    public function addAction()
    {
        $form = $this->MeetupForm;

        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $Meetup = $this->MeetupRepository->createMeetupFromNameAndDescription(
                    $form->getData()['title'],
                    $form->getData()['description'] ?? '',
                    $form->getData()['startedAt'],
                    $form->getData()['endedAt']
                );
                $this->MeetupRepository->add($Meetup);
                return $this->redirect()->toRoute('Meetups');
            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
        ]);
    }
}
