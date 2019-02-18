<?php
/**
 * Created by PhpStorm.
 * User: Raslen
 * Date: 06/02/2019
 * Time: 17:22
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
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
     * @ORM\Column(name="entreprise",type="string",nullable=true)
     */
    protected $entreprise;

    /**
     * @return mixed
     */
    public function getBiographie()
    {
        return $this->biographie;
    }

    /**
     * @param mixed $biographie
     */
    public function setBiographie($biographie)
    {
        $this->biographie = $biographie;
    }

    /**
     * @return mixed
     */
    public function getDiplome()
    {
        return $this->diplome;
    }

    /**
     * @param mixed $diplome
     */
    public function setDiplome($diplome)
    {
        $this->diplome = $diplome;
    }

    /**
     * @return mixed
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * @param mixed $entreprise
     */
    public function setEntreprise($entreprise)
    {
        $this->entreprise = $entreprise;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getNumtel()
    {
        return $this->numtel;
    }

    /**
     * @param mixed $numtel
     */
    public function setNumtel($numtel)
    {
        $this->numtel = $numtel;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getTofcin()
    {
        return $this->tofcin;
    }

    /**
     * @param mixed $tofcin
     */
    public function setTofcin($tofcin)
    {
        $this->tofcin = $tofcin;
    }

    /**
     * @ORM\Column(name="nom",type="string",nullable=true)
     */
    protected $nom;

    /**
     * @ORM\Column(name="prenom",type="integer",nullable=true)
     */
    protected $prenom;

    /**
     * @ORM\Column(name="diplome",type="string",nullable=true)
     */
    protected $diplome;

    /**
     * @ORM\Column(name="tofcin",type="string",nullable=true)
     */
    protected $tofcin;

    /**
     * @ORM\Column(name="biographie",type="text",nullable=true)
     */
    protected $biographie;

    /**
     * @ORM\Column(name="numtel",type="integer",nullable=true)
     */
    protected $numtel;



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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}