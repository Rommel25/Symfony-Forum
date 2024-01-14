<?php

namespace App\Service;

use App\Entity\Lyceen;
use Doctrine\ORM\EntityManagerInterface;

class EncryptDataService
{
    public function __construct(private EntityManagerInterface $em){}

    public function hashService(Lyceen $lyceen){
        $lyceen->getUser()->setEmail(md5($lyceen->getUser()->getEmail()));
        $lyceen->getUser()->setNom(md5($lyceen->getUser()->getNom()));
        $lyceen->getUser()->setPrenom(md5($lyceen->getUser()->getPrenom()));
        $lyceen->getUser()->setTelephone(md5($lyceen->getUser()->getTelephone()));
        $lyceen->getUser()->setHashed(true);
        $this->em->flush();
    }

}