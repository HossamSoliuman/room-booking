<?php

namespace App\Licht\Services;

use Illuminate\Support\Str;


class MakeMigrationService
{
    public function make($model, $fields)
    {
        // Generate the migration file name
        $migrationName =Str::plural(Str::snake($model));

        $timestamp = now()->format('Y_m_d_His');
        $filename = "{$timestamp}_create_{$migrationName}_table.php";

        // Load the migration stub file
        $stub = file_get_contents(__DIR__ . '/../mystubs/migration.create.stub'); 
        // Replace the {{ table }} placeholder with the actual table name
        $stub = str_replace('{{ table }}', $migrationName, $stub);

        // Generate the field definitions
        $fieldDefinitions = '';
        foreach ($fields as $fieldName => $fieldType) {
            if ($fieldType == 'foreignId') {
                $fieldDefinitions .= "\t\t\t\$table->{$fieldType}('{$fieldName}')->constrained()->cascadeOnDelete();\n";
                continue;
            }
            $fieldDefinitions .= "\t\t\t\$table->{$fieldType}('{$fieldName}');\n";
        }

        // Replace the {{ fields }} placeholder with the actual field definitions
        $stub = str_replace('{{ fields }}', $fieldDefinitions, $stub);

        // Write the migration file
        $path = database_path("migrations/{$filename}");
        file_put_contents($path, $stub);

        // Return the migration file name
        return $filename;
    }
}
