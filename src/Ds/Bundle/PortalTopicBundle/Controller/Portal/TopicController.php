<?php

namespace Ds\Bundle\PortalTopicBundle\Controller\Portal;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class TopicController
 *
 * @Route("/topic")
 */
class TopicController extends Controller
{
    /**
     * Index action
     *
     * @Route("s")
     * @Template()
     */
    public function indexAction()
    {
        $manager = $this->get('ds.topic.manager.topic');
        $topics = $manager->getList();

        return [
            'topics' => $topics
        ];
    }

    /**
     * View action
     *
     * @param integer $id
     * @return array
     * @Route("/{id}")
     * @Template()
     */
    public function viewAction($id)
    {
        $user = $this->getUser();

        $manager = $this->get('ds.topic.manager.topic');
        $topic = $manager->find($id);

        $manager = $this->get('ds.topic.manager.subscription');
        $subscription = $manager->getList(1, 1, [
            'user' => $user,
            'topic' => $topic
        ]);
        $subscription = array_shift($subscription);

        if (!$subscription) {
            $subscription = $manager->createEntity()
                ->setUser($user)
                ->setTopic($topic);
        }

        $form = $this->createForm('ds_portaltopic_portal_subscription', $subscription, [
            'topic' => $topic
        ]);

        return [
            'topic' => $topic,
            'subscription' => $subscription,
            'form' => $form->createView()
        ];
    }
}
