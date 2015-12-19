<?php

namespace Pages\PagesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Pages\PagesBundle\Validator\Constraints as CustomAssert;


/**
 * Pages
 *
 * @ORM\Table("pages")
 * @ORM\Entity(repositoryClass="Pages\PagesBundle\Repository\PagesRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Pages
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     *
     */
    private $deletedAt;



    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created; // sur les extension doctrine, pas bespoin def aire les getter et les setters, sauf si on veut recup la data dans le code il faudra les getter et setter

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;


    /**
     * @Gedmo\Timestampable(on="change", field={"titre"})
     * @ORM\Column(name="titleChanged", type="datetime", nullable=true)
     */
    private $titleChanged; // evenement perso, on timestamp le changement dune colonne titre

    /**
     * @ORM\column(length=128, unique=true)
     * @Gedmo\Slug(fields={"created","titre"})
     *
     */
    private $slug;


    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     *
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     * @CustomAssert\constraintsCheckUrl(test="lalali")
     */
    private $contenu;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Pages
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Pages
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }



    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set deletedAt
     *
     * @param datetime $deletedAt
     * @return Pages
     */
    public function setdeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}
