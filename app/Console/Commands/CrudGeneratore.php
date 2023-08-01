<?php

namespace App\Console\Commands;

use App\Licht\Services\MakeControllerService;
use App\Licht\Services\MakeFactoryService;
use App\Licht\Services\MakeMigrationService;
use App\Licht\Services\MakeModelService;
use App\Licht\Services\MakeRequestsService;
use App\Licht\Services\MakeResourceService;
use App\Licht\Services\MakeSeederService;
use Illuminate\Console\Command;

class CrudGeneratore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:model {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generating CRUDs';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $isThereMore = 'yes';
        $fields = [];
        while ($isThereMore == 'yes') {
            $fieledType = $this->choice(
                'choice field type ',
                ['string', 'integer', 'text', 'foreignId'],
                0
            );
            $fieledName = $this->ask('Enter field name', 'name');

            $fields[$fieledName] = $fieledType;
            $isThereMore = $this->choice(
                'Are there any more fields?',
                ['yes', 'no'],
                0
            );
        }
        $model = $this->argument('name');

        $migration = new MakeMigrationService;
        $migration->make($model, $fields);

        $requests = new MakeRequestsService;
        $requests->create($model, $fields);

        $modelFile = new MakeModelService;
        $modelFile->create($model, $fields);

        $factory = new MakeFactoryService;
        $factory->create($model, $fields);

        $seeder = new MakeSeederService;
        $seeder->create($model);

        $resource = new MakeResourceService;
        $resource->create($model, $fields);

        $controller = new MakeControllerService;
        $controller->create($model);

        return Command::SUCCESS;
    }
}
