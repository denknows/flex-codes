<?php

declare(strict_types=1);

namespace Codes\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Codes\App\Entities\Customer;
use Codes\App\Repositories\CustomerPersistence;
use Codes\App\Repositories\CustomerRepository;
use Codes\App\Transformers\CustomerTransformer;
use Doctrine\ORM\EntityManagerInterface;

final class RetrieveCustomerController extends Controller
{
    private CustomerRepository $repository;

    public function __construct()
    {
        $this->repository = new CustomerRepository(new CustomerPersistence());
    }

    public function __invoke(EntityManagerInterface $em, int $id)
    {
        $this->repository->findById($id);

        $customer = $em->getRepository(Customer::class)
            ->findOneBy([
                'id' => $id
            ]);

        return response()->json(
            [
                'data' => (new CustomerTransformer)->transform($customer)
            ],
            200
        );
    }
}
