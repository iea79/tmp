<?php
namespace DaVinci\TaxiBundle\Entity\Admin;

use Doctrine\ORM\EntityRepository;

/**
 * 
 * CountryCityRepository
 */

class CountryCityRepository extends EntityRepository
{
    public function getCountryCodeByCity($city)
    {
        $query = $repository->createQueryBuilder('c')
            ->select('c.countryCode')
            ->where('c.city = :city')
            ->setParameter('city', $city)
            ->getQuery();

        return $query->getSingleResult();
    }
    
}