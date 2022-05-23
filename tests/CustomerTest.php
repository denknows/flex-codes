<?php

use Codes\App\Entities\Customer;
use Codes\App\Repositories\CustomerPersistence;
use Codes\App\Repositories\CustomerRepository;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CustomerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_it_can_create_a_customer()
    {
        $customer = Customer::factory()->make();

        $data = [
            'first_name' => $customer->getFirstName(),
            'last_name' => $customer->getLastName(),
            'username' => $customer->getUsername(),
            'password' => $customer->getPassword(),
            'email' => $customer->getEmail(),
            'gender' => $customer->getGender(),
            'country' => $customer->getCountry(),
            'city' => $customer->getCity(),
            'phone' => $customer->getPhone()
        ];

        $this->post('/customers', $data)
            ->seeStatusCode(201)
            ->seeJsonStructure(
                [
                    'data' =>
                    [
                        'name',
                        'username',
                        'email'
                    ]
                ]
            );
    }

    public function test_it_cannot_retrieve_a_customer()
    {
        $this->expectException(OutOfBoundsException::class);

        $data = $this->getDummyData();

        $customerData = new Customer($data);

        $repository = new CustomerRepository(new CustomerPersistence());

        $repository->save($repository->create($customerData));

        $repository->findById(1110000);
    }

    public function test_it_can_retrieve_a_customer()
    {
        $data = $this->getDummyData();

        $customerData = new Customer($data);

        $repository = new CustomerRepository(new CustomerPersistence());

        $newData = $repository->create($customerData);

        $repository->save($customerData);

        $customerId = $repository->findById($newData->getId())->getId();

        $this->assertEquals($newData->getId(), $customerId);
    }

    public function test_it_can_retrieve_all_customer()
    {
        for ($i = 0; $i < 10; $i++) {
            $data = $this->getDummyData();

            $customerData = new Customer($data);

            $repository = new CustomerRepository(new CustomerPersistence());

            $repository->create($customerData);

            $repository->save($customerData);
        }

        $customers = $repository->findAll();

        $this->assertEquals(10, count($customers));
    }

    private function getDummyData()
    {
        $customer = Customer::factory()->make();

        return [
            'first_name' => $customer->getFirstName(),
            'last_name' => $customer->getLastName(),
            'username' => $customer->getUsername(),
            'password' => $customer->getPassword(),
            'email' => $customer->getEmail(),
            'gender' => $customer->getGender(),
            'country' => $customer->getCountry(),
            'city' => $customer->getCity(),
            'phone' => $customer->getPhone()
        ];
    }
}
