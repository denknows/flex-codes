<?php

declare(strict_types=1);

namespace Codes\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Codes\App\Repositories\CustomerPersistence;
use Codes\App\Repositories\CustomerRepository;
use Codes\App\Transformers\CustomerTransformer;

final class RetrieveAllCustomerController extends Controller
{
    private CustomerRepository $repository;

    public function __construct()
    {
        $this->repository = new CustomerRepository(new CustomerPersistence());
    }

    public function __invoke()
    {
        $customers = $this->repository->findAll();

        return (new CustomerTransformer)
            ->transformAll($customers);
    }
}
