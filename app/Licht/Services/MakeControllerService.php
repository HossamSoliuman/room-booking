<?php

namespace App\Licht\Services;

use Illuminate\Support\Str;


class MakeControllerService
{
    public function create($model)
    {
        $modelVariable = Str::camel($model);
        $fileName = $model . 'Controller.php';
        $stub = file_get_contents(__DIR__ . '/../mystubs/controller.api.stub');
        $stub = str_replace('{{ model }}', $model, $stub);
        $stub = str_replace('{{ modelVariable }}', $modelVariable, $stub);
        $path = app_path("Http/Controllers/{$fileName}");
        file_put_contents($path, $stub);
    }
}
