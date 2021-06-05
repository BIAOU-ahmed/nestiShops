<?php
// src/Form/DataTransformer/IssueToNumberTransformer.php
namespace App\Form\DataTransformer;

use App\Entity\City;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class CityToStringTransformer implements DataTransformerInterface
{    
    /**
     * entityManager
     *
     * @var mixed
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param City|null $city
     */
    public function transform($city): string
    {
        if (null === $city) {
            return '';
        }

        return $city->getName();
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param string $cityName
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($cityName): ?City
    {
// no issue number? It's optional, so that's ok
        if (!$cityName) {
            return null;
        }

        $city = $this->entityManager
            ->getRepository(City::class)
// query for the issue with this id
            ->findOneBy(['name'=>$cityName]);

        if (null === $city) {
// causes a validation error
// this message is not shown to the user
// see the invalid_message option
//            throw new TransformationFailedException(sprintf(
//                'An issue with number "%s" does not exist!',
//                $cityName
//            ));
            $city = new City();
            $city->setName($cityName);
        }

        return $city;
    }
}
