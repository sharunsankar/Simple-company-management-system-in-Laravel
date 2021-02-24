<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['first_name', 'last_name', 'company_id', 'email', 'phone', 'designation', 'status', 'created_at' ];

    public function company()
    {
    	return $this->belongsTo(Company::class,'company_id');
    }
}
