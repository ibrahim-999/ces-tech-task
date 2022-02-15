<?php

namespace App;

use App\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{
    use Notifiable;
    /** Attribute to be mass assigned */
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'company_id', 'image'];


    /** Relationships */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
