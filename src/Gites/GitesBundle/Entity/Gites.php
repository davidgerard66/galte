<?php

namespace Gites\GitesBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * gites
 *
 * @ORM\Table()
 * @Gedmo\Loggable()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @ORM\Entity(repositoryClass="Gites\GitesBundle\Repository\GitesRepository")
 */
class Gites
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
     * @Gedmo\Slug(fields={"ville","nom"}, prefix="Gites_Ruraux_Cerdagne_", style="camel", separator="_")
     * @ORM\Column(name="slug", length=120, unique=true )
     *
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=25)
     */
    private $nom;

    /**
     * @ORM\OneToOne(targetEntity="Gites\GitesBundle\Entity\Media")
     * @ORM\JoinColumn(nullable=true)
     */
    private $vignette;


    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=25)
     */
    private $ville;

    /**
     * @var integer
     *
     * @ORM\Column(name="epis", type="integer")
     */
    private $epis;

    /**
     * @var integer
     *
     * @ORM\Column(name="personnes", type="integer")
     */
    private $personnes;

    /**
     * @var integer
     *
     * @ORM\Column(name="chambres", type="integer")
     */
    private $chambres;

    /**
     * @var integer
     *
     * @ORM\Column(name="surface", type="integer")
     */
    private $surface;

    /**
     * @var boolean
     *
     * @ORM\Column(name="animaux_acceptes", type="boolean")
     */
    private $animauxAcceptes;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cv_acceptes", type="boolean")
     */
    private $cvAcceptes;

    /**
     * @var string
     *
     * @ORM\Column(name="url_dispo", type="string", length=255)
     */
    private $urlDispo;

    /**
     * @var string
     *
     * @ORM\Column(name="url_tarif", type="string", length=255)
     */
    private $urlTarif;

    /**
     * @var string
     *
     * @ORM\Column(name="url_map", type="string", length=300)
     */
    private $urlMap;

    /**
     * @var string
     * @Gedmo\Versioned
     * @ORM\Column(name="equipements", type="text")
     */
    private $equipements;

    /**
     * @var string
     * @Gedmo\Versioned
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     * @Gedmo\Versioned
     * @ORM\Column(name="description_courte", type="text")
     */
    private $descriptionCourte;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return gites
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return gites
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set epis
     *
     * @param integer $epis
     *
     * @return gites
     */
    public function setEpis($epis)
    {
        $this->epis = $epis;

        return $this;
    }

    /**
     * Get epis
     *
     * @return integer
     */
    public function getEpis()
    {
        return $this->epis;
    }

    /**
     * Set personnes
     *
     * @param integer $personnes
     *
     * @return gites
     */
    public function setPersonnes($personnes)
    {
        $this->personnes = $personnes;

        return $this;
    }

    /**
     * Get personnes
     *
     * @return integer
     */
    public function getPersonnes()
    {
        return $this->personnes;
    }

    /**
     * Set chambres
     *
     * @param integer $chambres
     *
     * @return gites
     */
    public function setChambres($chambres)
    {
        $this->chambres = $chambres;

        return $this;
    }

    /**
     * Get chambres
     *
     * @return integer
     */
    public function getChambres()
    {
        return $this->chambres;
    }

    /**
     * Set surface
     *
     * @param integer $surface
     *
     * @return gites
     */
    public function setSurface($surface)
    {
        $this->surface = $surface;

        return $this;
    }

    /**
     * Get surface
     *
     * @return integer
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * Set animauxAcceptes
     *
     * @param boolean $animauxAcceptes
     *
     * @return gites
     */
    public function setAnimauxAcceptes($animauxAcceptes)
    {
        $this->animauxAcceptes = $animauxAcceptes;

        return $this;
    }

    /**
     * Get animauxAcceptes
     *
     * @return boolean
     */
    public function getAnimauxAcceptes()
    {
        return $this->animauxAcceptes;
    }

    /**
     * Set cvAcceptes
     *
     * @param boolean $cvAcceptes
     *
     * @return gites
     */
    public function setCvAcceptes($cvAcceptes)
    {
        $this->cvAcceptes = $cvAcceptes;

        return $this;
    }

    /**
     * Get cvAcceptes
     *
     * @return boolean
     */
    public function getCvAcceptes()
    {
        return $this->cvAcceptes;
    }

    /**
     * Set urlDispo
     *
     * @param string $urlDispo
     *
     * @return gites
     */
    public function setUrlDispo($urlDispo)
    {
        $this->urlDispo = $urlDispo;

        return $this;
    }

    /**
     * Get urlDispo
     *
     * @return string
     */
    public function getUrlDispo()
    {
        return $this->urlDispo;
    }

    /**
     * Set urlTarif
     *
     * @param string $urlTarif
     *
     * @return gites
     */
    public function setUrlTarif($urlTarif)
    {
        $this->urlTarif = $urlTarif;

        return $this;
    }

    /**
     * Get urlTarif
     *
     * @return string
     */
    public function getUrlTarif()
    {
        return $this->urlTarif;
    }

    /**
     * Set urlMap
     *
     * @param string $urlMap
     *
     * @return gites
     */
    public function setUrlMap($urlMap)
    {
        $this->urlMap = $urlMap;

        return $this;
    }

    /**
     * Get urlMap
     *
     * @return string
     */
    public function getUrlMap()
    {
        return $this->urlMap;
    }

    /**
     * Set equipements
     *
     * @param string $equipements
     *
     * @return gites
     */
    public function setEquipements($equipements)
    {
        $this->equipements = $equipements;

        return $this;
    }

    /**
     * Get equipements
     *
     * @return string
     */
    public function getEquipements()
    {
        return $this->equipements;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return gites
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function __toString()
    {
        return $this->getNom();
    }

    /**
     * Set vignette
     *
     * @param \Gites\GitesBundle\Entity\Media $vignette
     *
     * @return Gites
     */
    public function setVignette(\Gites\GitesBundle\Entity\Media $vignette = null)
    {
        $this->vignette = $vignette;

        return $this;
    }

    /**
     * Get vignette
     *
     * @return \Gites\GitesBundle\Entity\Media
     */
    public function getVignette()
    {
        return $this->vignette;
    }

    /**
     * Set descriptionCourte
     *
     * @param string $descriptionCourte
     *
     * @return Gites
     */
    public function setDescriptionCourte($descriptionCourte)
    {
        $this->descriptionCourte = $descriptionCourte;

        return $this;
    }

    /**
     * Get descriptionCourte
     *
     * @return string
     */
    public function getDescriptionCourte()
    {
        return $this->descriptionCourte;
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
}
