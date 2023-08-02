<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use App\Traits\ManagesFiles;
trait ManageModelFiles{
    use ManagesFiles;
    public function store($files,$model,$dir)
    {
        foreach($files as $file){
            $path=$this->uploadFile($file,$dir);
            $model::create([
                
            ]);
        }
    }
}