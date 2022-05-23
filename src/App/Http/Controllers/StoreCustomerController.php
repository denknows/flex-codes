<?php

declare(strict_types=1);

namespace Codes\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Codes\App\Entities\Customer;
use Codes\App\Repositories\CustomerPersistence;
use Codes\App\Repositories\CustomerRepository;
use Codes\App\Transformers\CustomerTransformer;
use Illuminate\Http\Request;

final class StoreCustomerController extends Controller
{
    private CustomerRepository $repository;

    public function __construct()
    {
        $this->repository = new CustomerRepository(new CustomerPersistence());
    }

    public function __invoke(Request $request)
    {
        $customer = new Customer($this->validateData($request));

        $this->repository->save($this->repository->create($customer));

        return response()->json(
            [
                'data' => (new CustomerTransformer)->transform($customer)
            ],
            201
        );
    }

    private function validateData(Request $request)
    {
        return $this->validate(
            $request,
            [
                'first_name' => ['required'],
                'last_name' => ['required'],
                'email' => ['required', 'email'],
                'username' => ['required'],
                'password' => ['required'],
                'gender' => ['required'],
                'country' => ['required'],
                'city' => ['required'],
                'phone' => ['nullable'],
            ]
        );
    }
}
