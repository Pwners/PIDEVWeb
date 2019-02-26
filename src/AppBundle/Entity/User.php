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
use Symfony\Component\Validator\Constraints as Assert;
use Mgilet\NotificationBundle\Annotation\Notifiable;
use Mgilet\NotificationBundle\NotifiableInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 * @Vich\Uploadable
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
     * @ORM\Column(name="prenom",type="string",nullable=true)
     */
    protected $prenom;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="S'il vous plais, telecharger votre diplome en forme PDF.")
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    private $diplome;


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
     * @Vich\UploadableField(mapping="user_images", fileNameProperty="imageCin")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageCin;
    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageProfile;

    /**
     * @return mixed
     */
    public function getImageProfile()
    {
        return $this->imageProfile;
    }

    /**
     * @param mixed $imageProfile
     */
    public function setImageProfile($imageProfile)
    {
        $this->imageProfile = $imageProfile;
    }

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageCin($imageCin)
    {
        $this->imageCin = $imageCin;
        return $this;
    }

    public function getImageCin()
    {
        return $this->imageCin;
    }



    /**
     * @return mixed
     */

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