<?php

namespace App\Licht\Services;

class MakeResourceService
{
    public function create($model, $fields)
    {
        $stub = file_get_contents(__DIR__ . '/../mystubs/resource.stub');
        $fileName = $model . 'Resource.php';
        $stub = str_replace('{{ model }}', $model, $stub);
        $coulumns = '';
        foreach ($fields as $fieldName => $fieldType) {
            $coulumns .= "\t\t\t'{$fieldName}'=> "."$"."this->{$fieldName},\n";
        }
        $stub = str_replace('{{ fields }}', $coulumns, $stub);
        $path = app_path("Http/Resources/{$fileName}");
        file_put_contents($path, $stub);
    }
}
