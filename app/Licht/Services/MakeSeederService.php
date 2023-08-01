<?php

namespace App\Licht\Services;

class MakeSeederService
{
    public function create($model)
    {
        $fileName = $model . 'Seeder.php';
        $stub = file_get_contents(__DIR__ . '/../mystubs/seeder.stub');
        $stub = str_replace('{{ model }}', $model, $stub);
        $path = database_path("seeders/{$fileName}");
        file_put_contents($path, $stub);
    }
}
