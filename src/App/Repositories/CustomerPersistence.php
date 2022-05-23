<?php

declare(strict_types=1);

namespace Codes\App\Repositories;

use Codes\App\Repositories\CustomerInterface;
use OutOfBoundsException;

final class CustomerPersistence implements CustomerInterface
{
    private array $data = [];

    public function persist(array $params): void
    {
        $this->data[$params['id']] = $params;
    }

    public function retrieve(int $id): array
    {
        if (!isset($this->data[$id])) {
            throw new OutOfBoundsException(sprintf('No data found for ID %d', $id));
        }

        return $this->data[$id];
    }

    public function retrieveAll(): array
    {
        return $this->data;
    }
}
