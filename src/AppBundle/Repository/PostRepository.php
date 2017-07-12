<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{

    public function findWithImage($id)
    {
        return $this->createQueryBuilder('p')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->innerJoin('p.images', 'images')
            ->addSelect('images')
            ->getQuery()
            ->getOneOrNullResult();

    }

}