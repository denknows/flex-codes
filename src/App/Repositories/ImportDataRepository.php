<?php

declare(strict_types=1);

namespace Codes\App\Repositories;

use Illuminate\Support\Facades\Http;

final class ImportDataRepository
{
    private ImportDataPersistence $persistence;

    public function __construct(ImportDataInterface $persistence)
    {
        $this->persistence = $persistence;
    }

    public function importData(string $url, int $results = 25, string $nationality = 'au'): void
    {
        $data = Http::get("{$url}?nat={$nationality}&results={$results}");

        foreach ($data['results'] as $item) {
            $this->persistence->doImportData($item);
        }
    }
}
