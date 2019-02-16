<?php
/**
 * Created by PhpStorm.
 * User: arif
 * Date: 16/02/2019
 * Time: 00:20
 */

namespace fixit\ServiceBundle\Entity;
use AppBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Mgilet\NotificationBundle\Entity\NotificationInterface;
use Mgilet\NotificationBundle\Model\Notification as NotificationModel;


/**
 * @ORM\Entity
 * @ORM\Table(name="notifications")
 */
class Notification extends NotificationModel implements NotificationInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="notification" ,cascade={"persist"})
     * @ORM\JoinColumn(name="user", referencedColumnName="id",nullable=false)
     */
    protected $user;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Notification
     */
    public function setUser($user)
    {
        $this->user = $user;
        $user->addNotification($this);

        return $this;
    }

    /**
     * Get seen
     *
     * @return boolean
     */
    public function getSeen()
    {
        return $this->seen;
    }

}