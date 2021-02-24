<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'email', 'logo', 'website', 'status', 'created_at' ];

    public function employee()
	{
		return $this->hasMany(Employee::class,'company_id','id');
	}
    
}
