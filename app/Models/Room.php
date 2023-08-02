<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Room extends Model
{
	use HasFactory;
	const PATH = 'images/rooms';
	protected $fillable = [
		'activated',
		'title',
		'description',
		'city_id',
		'location',
		'user_id',
		'price_per_day',
		'number_of_beds',

	];


	public function city()
	{
		return $this->belongsTo(City::class);
	}
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function roomImages()
	{
		return $this->hasMany(RoomImage::class);
	}

	public function bookMarks()
	{
		return $this->hasMany(BookMark::class);
	}

	public function roomBooks()
	{
		return $this->hasMany(RoomBook::class);
	}
}
