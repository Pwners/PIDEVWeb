<?php

namespace fixit\ServiceBundle\Repository;

/**
 * tacheRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class tacheRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByNom($nom){

        $dqlresult=$this->getEntityManager()->createQuery("SELECT m FROM fixitServiceBundle:tache m where m.nom= '$nom'");
        return $dqlresult->getResult();
    }
}
