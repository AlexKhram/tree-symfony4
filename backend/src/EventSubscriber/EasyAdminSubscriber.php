<?php

namespace App\EventSubscriber;

use App\Entity\Person;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use App\Entity\Post;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    /** @var EntityManagerInterface $em */
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return array(
            'easy_admin.pre_persist' => array('setPostSlug'),
            'easy_admin.pre_update'  => array('setPostSlug'),
        );
    }

    public function setPostSlug(GenericEvent $event)
    {
        $entity = $event->getSubject();
        if (!($entity instanceof Person)) {
            return;
        }
        foreach($entity->getChildren() as $child) {
            $child->addParent($entity);
            //$this->em->persist($child);
        }
    }
}