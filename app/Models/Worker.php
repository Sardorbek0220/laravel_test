<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'passport',
        'lastname',
        'secondname',
        'firstname',
        'position',
        'phone',
        'address',
        'company_id',
        'created_at',
        'updated_at'
    ];

    public function company(){
        return $this->belongsTo(Company::class, 'company_id');
    }
}
