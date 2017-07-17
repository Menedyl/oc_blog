<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

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

}