<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'start_date', 'end_date', 'social_security_number', 'citizen_number'];
    protected $appends = ['full_name'];
    protected $dates = ['start_date', 'end_date'];

    public function leaves(): HasMany
    {
        return $this->hasMany(Leave::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
