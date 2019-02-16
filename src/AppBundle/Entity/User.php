<?php
/**
 * Created by PhpStorm.
 * User: Raslen
 * Date: 06/02/2019
 * Time: 17:22
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use fixit\ServiceBundle\Entity\Notifications;
use FOS\UserBundle\Model\User as BaseUser;
use Mgilet\NotificationBundle\NotifiableInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 */
class User extends BaseUser implements NotifiableInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var Notifications
     * @ORM\OneToMany(targetEntity="fixit\ServiceBundle\Entity\Notifications", mappedBy="User", orphanRemoval=true ,cascade={"persist"})
     */
    protected $notifications;

    /**
     * User constructor.
     * @param $id
     */
    public function __construct()
    {
        parent::__construct();

        $this->notifications = new ArrayCollection();
    }

    /**
     * @return Notifications
     */
    public function getNotifications()
    {
        return $this->notifications;
    }
    /**
     * {@inheritdoc}
     */
    public function addNotification($notification)
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications[] = $notification;
            $notification->setUser($this);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeNotification($notification)
    {
        if ($this->notifications->contains($notification)) {
            $this->notifications->removeElement($notification);
        }

        return $this;
    }

    /**
     * @param Notifications $notifications
     */
    public function setNotifications($notifications)
    {
        $this->notifications = $notifications;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}