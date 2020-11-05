<?php

namespace App\Services;

use App\Entity\Customers;

use Doctrine\ORM\EntityManagerInterface;

class Fetcher {

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function get($url) {

        $result = file_get_contents($url);

        $data = json_decode($result, true);

        //create a function that saves the data later & update when customer email exists
        foreach($data['results'] as $field => $value) {

            $entityManager= $this->entityManager;

            $customer = new Customers();

            $customer->setFirstName($value['name']['first']);
            $customer->setLastName($value['name']['last']);
            $customer->setEmail($value['email']);
            $customer->setGender($value['gender']);
            $customer->setCountry($value['location']['country']);
            $customer->setCity($value['location']['city']);
            $customer->setPhone($value['phone']);

            $entityManager->persist($customer);

            $entityManager->flush();

        }

        return true;

    }

}
