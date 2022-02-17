<?php

namespace App;

use App\User;
use App\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    use HasFactory;
    /** Attribute to be mass assigned */
    protected $fillable = ['name', 'address', 'user_id','image'];

    protected $table = "companies";

    /** Relationships */
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }
}
