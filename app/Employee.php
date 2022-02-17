<?php

namespace App;

use App\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{
    use Notifiable;
    use HasFactory;
    /** Attribute to be mass assigned */
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'company_id', 'image'];

    protected $table = "employees";


    /** Relationships */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
