<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class City extends Model
{
    use HasFactory;
    protected $fillable=[
			'name',

    ];



	public function rooms(){
		return $this->hasMany(Room::class);
	}

	public function favoriteCities(){
		return $this->hasMany(FavoriteCity::class);
	}
}