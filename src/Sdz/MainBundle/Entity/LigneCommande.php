<?php

namespace Sdz\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneCommande
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sdz\MainBundle\Entity\LigneCommandeRepository")
 */
class LigneCommande
{
    /**
		* @ORM\Id
		* @ORM\ManyToOne(targetEntity="Sdz\MainBundle\Entity\Produit")
		*/
		private $produit;
	
		/**
		* @ORM\Id
		* @ORM\ManyToOne(targetEntity="Sdz\MainBundle\Entity\Commande")
		*/
		private $commande;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;


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
     * Set quantite
     *
     * @param integer $quantite
     * @return LigneCommande
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set produit
     *
     * @param \Sdz\MainBundle\Entity\Produit $produit
     * @return LigneCommande
     */
    public function setProduit(\Sdz\MainBundle\Entity\Produit $produit)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \Sdz\MainBundle\Entity\Produit 
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set commande
     *
     * @param \Sdz\MainBundle\Entity\Commande $commande
     * @return LigneCommande
     */
    public function setCommande(\Sdz\MainBundle\Entity\Commande $commande)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \Sdz\MainBundle\Entity\Commande 
     */
    public function getCommande()
    {
        return $this->commande;
    }
}
