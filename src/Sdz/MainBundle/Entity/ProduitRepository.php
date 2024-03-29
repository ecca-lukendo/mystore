<?php

namespace Sdz\MainBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ProduitRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProduitRepository extends EntityRepository
{

	public function findProdCat($id)
	{
		$qb = $this->createQueryBuilder('p');
		
		$qb->join('p.categorie', 'c')
			->where('c.id = :id')
			->setParameter('id', $id);

		return $qb->getQuery()
						->getResult();
		
	}
}
