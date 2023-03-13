<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'director',
        'address',
        'email',
        'website',
        'phone',
        'created_at',
        'updated_at'
    ];

    public function workers()
	{
		return $this->hasMany(Worker::class);
	}
}
