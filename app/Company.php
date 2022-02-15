<?php

namespace App;

use App\User;
use App\Employee;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /** Attribute to be mass assigned */
    protected $fillable = ['name', 'email', 'phone', 'location', 'user_id'];

    /** Relationhsips */
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }
}
