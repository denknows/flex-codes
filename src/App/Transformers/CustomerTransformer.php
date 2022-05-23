<?php

namespace Codes\App\Transformers;

use Codes\App\Entities\Customer;

class CustomerTransformer
{
    public function transform(Customer $customer)
    {
        return [
            'id' => $customer->getId(),
            'name' => $customer->getFirstName() . " " . $customer->getLastName(),
            'username' => $customer->getUsername(),
            'email' => $customer->getEmail(),
            'gender' => $customer->getGender(),
            'city' => $customer->getCity(),
            'country' => $customer->getCountry(),
            'phone' => $customer->getPhone(),
        ];
    }

    public function transformAll(array $customers)
    {
        return collect($customers)
            ->map(fn ($customer) => $this->transform($customer));
    }
}
