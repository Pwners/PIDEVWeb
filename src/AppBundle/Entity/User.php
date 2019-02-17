<?php
/**
 * Created by PhpStorm.
 * User: Raslen
 * Date: 06/02/2019
 * Time: 17:22
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use fixit\ServiceBundle\Entity\Notification;
use FOS\UserBundle\Model\User as BaseUser;
use Mgilet\NotificationBundle\Annotation\Notifiable;
use Mgilet\NotificationBundle\NotifiableInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 * @Notifiable(name="user")
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
     * @var Notification
     * @ORM\OneToMany(targetEntity="fixit\ServiceBundle\Entity\Notification", mappedBy="User", orphanRemoval=true ,cascade={"persist"})
     */
    protected $notification;

    /**
     * @ORM\ManyToOne(targetEntity="fixit\ServiceBundle\Entity\Categorie",inversedBy="pro")
     * @ORM\JoinColumn(name="categories", referencedColumnName="id")
     */
    private $categories;

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * User constructor.
     * @param $id
     */
    public function __construct()
    {
        parent::__construct();

        $this->notification = new ArrayCollection();
    }

    /**
     * @return Notification
     */
    public function getNotification()
    {
        return $this->notification;
    }
    /**
     * {@inheritdoc}
     */
    public function addNotification($notification)
    {
        if (!$this->notification->contains($notification)) {
            $this->notification[] = $notification;
            $notification->setUser($this);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeNotification($notification)
    {
        if ($this->notification->contains($notification)) {
            $this->notification->removeElement($notification);
        }

        return $this;
    }

    /**
     * @param Notification $notification
     */
    public function setNotification($notification)
    {
        $this->notification = $notification;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}