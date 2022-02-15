<?php

namespace App;

use App\Company;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** Attribute to be mass assigned */
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'company_id', 'image'];


    /** Relationships */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
