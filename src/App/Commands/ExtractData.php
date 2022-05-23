<?php

namespace Codes\App\Commands;

use Codes\App\Repositories\ImportDataInterface;
use Codes\App\Repositories\ImportDataPersistence;
use Codes\App\Repositories\ImportDataRepository;
use Illuminate\Console\Command;

class ExtractData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'extract:user {--results=200}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will extract data from 3rd party api.';

    private ImportDataRepository $repository;

    public function handle()
    {
        $results = $this->option('results');

        if ($results > 5000) {
            $this->info("Max data to be extracted is 5000!");
            $this->info("Request continue with 5000 results. Please wait ...");
            $results = 5000;
        }

        $this->repository = new ImportDataRepository(new ImportDataPersistence());

        $this->repository->importData('https://randomuser.me/api/', $results);

        $this->info("Data extraction done ({$results} items)!");
    }
}
