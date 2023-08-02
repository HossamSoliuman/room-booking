<?php

namespace App\Licht\Services;

use Illuminate\Support\Str;

class MakeRequestsService
{
    public function create($model, $fields)
    {
        $storeClass = 'Store' . $model . 'Request';
        $updateClass = 'Update' . $model . 'Request';
        $storeFileName = $storeClass . '.php';
        $updateFileName = $updateClass . '.php';


        $stub = file_get_contents(__DIR__ . '/../mystubs/request.stub');
        $storeStub = str_replace('{{ class }}', $storeClass, $stub);
        $updateStub = str_replace('{{ class }}', $updateClass, $stub);
        $storeRules = '';
        $updateRules = '';
        foreach ($fields as $fieldName => $fieldType) {
            if ($fieldType == 'foreignId') {
                $table = $this->getForeignKeyTable($fieldName);
                $storeRules .= "\t\t\t'{$fieldName}' => 'required|integer|exists:{$table},id',\n";
                $updateRules .= "\t\t\t'{$fieldName}' => 'nullable|integer|exists:{$table},id',\n";
                continue;
            }
            if ($fieldType == 'text') {
                $storeRules .= "\t\t\t'{$fieldName}' => 'required|string',\n";
                $updateRules .= "\t\t\t'{$fieldName}' => 'nullable|string',\n";
                continue;
            } elseif ($fieldType == 'date') {
                $storeRules .= "\t\t\t'{$fieldName}' => 'required|date',\n";
                $updateRules .= "\t\t\t'{$fieldName}' => 'nullable|date',\n";
                continue;
            } elseif ($fieldType == 'datetime') {
                $storeRules .= "\t\t\t'{$fieldName}' => 'required|date_time',\n";
                $updateRules .= "\t\t\t'{$fieldName}' => 'nullable|date_time',\n";
                continue;
            }
            $storeRules .= "\t\t\t'{$fieldName}' => 'required|{$fieldType}',\n";
            $updateRules .= "\t\t\t'{$fieldName}' => 'nullable|{$fieldType}',\n";
        }
        $storeStub = str_replace('{{ rules }}', $storeRules, $storeStub);
        $updateStub = str_replace('{{ rules }}', $updateRules, $updateStub);
        $storePath = app_path("Http/Requests/{$storeFileName}");
        $updatePath = app_path("Http/Requests/{$updateFileName}");
        file_put_contents($storePath, $storeStub);
        file_put_contents($updatePath, $updateStub);
    }
    public function getForeignKeyTable($foreignKey)
    {
        return $relatedTable = Str::plural(Str::remove('_id', $foreignKey));
    }
}
