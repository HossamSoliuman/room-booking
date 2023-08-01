<?php

namespace App\Licht\Services;

use Illuminate\Support\Str;

class MakeModelService
{
    public function create($model, $fields)
    {
        $stub = file_get_contents(__DIR__ . '/../mystubs/model.stub');
        $fileName = $model . '.php';
        $stub = str_replace('{{ class }}', $model, $stub);
        $fillables = '';
        $relations = '';
        foreach ($fields as $fieldName => $fieldType) {
            $fillables .= "\t\t\t'{$fieldName}',\n";
            if ($fieldType == 'foreignId') {
                $parent = Str::studly(Str::remove('_id', $fieldName));
                $parentMethod = Str::camel(Str::remove('_id', $fieldName));
                $childMethod = Str::plural(Str::camel($model));
                $childsPath = app_path("Models/{$parent}.php"); // Get the path to the parent model file
                // $childsFile = file_get_contents($childsPath); // Read the contents of the parent model file
                $lines = file($childsPath); // Read the contents of the file into an array
                $lastLine = array_pop($lines); // Remove the last line from the array
                $childRelation = "\n\tpublic function {$childMethod}(){\n\t\treturn $" . "this->hasMany({$model}::class);\n\t}\n}"; // Define the child relation string
                $newLastLine = $childRelation; // Define the new last line
                array_push($lines, $newLastLine); // Add the new last line to the array
                $newContent = implode('', $lines); // Join the array elements into a string
                file_put_contents($childsPath, $newContent); // Write the modified contents back to the file

                $relations .= "\n\tpublic function {$parentMethod}(){\n\t\treturn $" . "this->belongsTo({$parent}::class);\n\t}";
            }
        }
        $stub = str_replace('{{ fields }}', $fillables, $stub);
        $stub = str_replace('{{ relations }}', $relations, $stub);
        $path = app_path("Models/{$fileName}");
        file_put_contents($path, $stub);
    }
}
// post --> user_id 
