<?php

namespace Sdz\MainBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * LigneCommandeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LigneCommandeRepository extends EntityRepository
{
	public function getLignesCommande($id)
	{
		$query = $this->_em->createQuery('SELECT p.nom AS nom, p.prix AS prix,
		p.quantite As quantite FROM SdzMainBundle:Produit p, SdzMainBundle:Commande c, 
		SdzMainBundle:LigneCommande l WHERE l.commande = :id AND l.produit = p.id AND l.commande = c.id');
		
		$query->setParameter('id', $id);

		return $query->getResult();
	}
}