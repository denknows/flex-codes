<?php

declare(strict_types=1);

namespace Codes\App\Repositories;

interface ImportDataInterface
{
    public function doImportData(array $item = []): void;
}
