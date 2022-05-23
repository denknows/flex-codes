<?php

declare(strict_types=1);

namespace Codes\App\Repositories;

use Codes\App\Entities\Customer;
use Doctrine\ORM\EntityManagerInterface;
use OutOfBoundsException;

class CustomerRepository
{
    private EntityManagerInterface $em;
    private CustomerPersistence $persistence;

    public function __construct(CustomerInterface $persistence)
    {
        $this->persistence = $persistence;
    }

    public function create(Customer $customer): Customer
    {
        // TO DO: upsert or merge function will be used to insert and/or update data dynamically
        $this->em = app(EntityManagerInterface::class);
        $this->em->persist($customer);
        $this->em->flush();

        return $customer;
    }

    public function findById(int $id): Customer
    {
        try {
            $data = $this->persistence->retrieve($id);
        } catch (OutOfBoundsException $e) {
            throw new OutOfBoundsException(sprintf('Customer with id %d does not exist', $id), 0, $e);
        }

        return Customer::fromState($data);
    }

    public function findAll()
    {
        return $this->persistence->retrieveAll();
    }

    public function save(Customer $customer): void
    {
        $this->persistence->persist([
            'id' => $customer->getId(),
            'first_name' => $customer->getFirstName(),
            'last_name' => $customer->getLastName(),
            'username' => $customer->getUsername(),
            'password' => $customer->getPassword(),
            'email' => $customer->getEmail(),
            'gender' => $customer->getGender(),
            'city' => $customer->getCity(),
            'country' => $customer->getCountry(),
            'phone' => $customer->getPhone(),
        ]);
    }
}
