<?php 
namespace Acme\TaskBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use DaVinci\TaxiBundle\Entity\Admin\CountryCity;
use Symfony\Component\Intl\Intl;

class CountryCityToCountryTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  CountryCity|null $issue
     * @return string
     */
    public function transform($countrycity)
    {
        if (null === $countrycity) {
            return "";
        }

        return $countrycity->getCountry();
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $number
     *
     * @return CountryCity|null
     *
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($country)
    {
        if (!$country) {
            return null;
        }

        $cn = Intl::getRegionBundle()->getCountryNames();
        
        $cc = array_search($country,$cn);
        
        $issue = $this->om
            ->getRepository('DaVinciTaxiBundle:Admin:CountryCity')
            ->findOneBy(array('countryCode' => $cc))
        ;

        if (null === $issue) {
            throw new TransformationFailedException(sprintf(
                'An issue with country "%s" does not exist!',
                $country
            ));
        }

        return $issue;
    }
}