<?php

namespace App\Licht\Services;

class MakeFactoryService
{
    public function create($model, $fields)
    {
        $fileName = $model . 'Factory.php';
        $columns = '';
        foreach ($fields as $fieldName => $fieldType) {
            if ($fieldType == 'string') {
                $columns .= "\t\t\t'{$fieldName}' => fake()->text(50),\n";
            } elseif ($fieldType == 'text') {
                $columns .= "\t\t\t'{$fieldName}' => fake()->text(),\n";
            } elseif ($fieldType == 'foreignId') {
                $columns .= "\t\t\t'{$fieldName}' => fake()->numberBetween(1, 10),\n";
            } elseif ($fieldType == 'integer') {
                $columns .= "\t\t\t'{$fieldName}' => fake()->numberBetween(50, 200),\n";
            } elseif ($fieldType == 'date') {
                $columns .= "\t\t\t'{$fieldName}' => fake()->date(),\n";
            } elseif ($fieldType == 'datetime') {
                $columns .= "\t\t\t'{$fieldName}' => fake()->dateTime(),\n";
            }
        }
        $stub = file_get_contents(__DIR__ . '/../mystubs/factory.stub');
        $stub = str_replace('{{ factory }}', $model, $stub);
        $stub = str_replace('{{ fields }}', $columns, $stub);
        $path = database_path("factories/{$fileName}");
        file_put_contents($path, $stub);
    }
}