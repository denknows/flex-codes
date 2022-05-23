<?php

declare(strict_types=1);

namespace Codes\App\Repositories;

interface CustomerInterface
{
    public function persist(array $data): void;

    public function retrieve(int $id): array;

    public function retrieveAll(): array;
}
