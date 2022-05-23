<?php

declare(strict_types=1);

namespace Codes\App\Repositories;

use Codes\App\Entities\Customer;
use Codes\App\Repositories\CustomerInterface;
use Illuminate\Support\Facades\Http;

final class ImportDataPersistence implements ImportDataInterface
{
    private CustomerRepository $repository;

    public function __construct()
    {
        $this->repository = new CustomerRepository(new CustomerPersistence());
    }

    public function doImportData(array $item = []): void
    {
        $customerData = $this->doPrepareInsert($item);

        $customer = new Customer($customerData);

        $this->repository->save($this->repository->create($customer));
    }

    private function doPrepareInsert($item = []): array
    {
        return [
            'first_name' => $item['name']['first'],
            'last_name' => $item['name']['last'],
            'username' => $item['login']['username'],
            'password' => $item['login']['password'],
            'email' => $item['email'],
            'gender' => $item['gender'],
            'country' => $item['location']['country'],
            'city' => $item['location']['city'],
            'phone' => $item['phone'],
        ];
    }
}
