<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PostRepository extends EntityRepository
{

    public function findWithImage($id)
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.images', 'images')
            ->addSelect('images')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findAllWithImage($page, $nbPerPage)
    {
        return new Paginator(
            $this->createQueryBuilder('p')
                ->innerJoin('p.images', 'images')
                ->addSelect('images')
                ->orderBy('p.dateUpdate')
                ->getQuery()
                ->setFirstResult(($page - 1) * $nbPerPage)
                ->setMaxResults($nbPerPage)
            ,true);
    }

}