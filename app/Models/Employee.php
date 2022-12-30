<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\SearchTrait;

class Employee extends Model
{
    use HasFactory;
    use SearchTrait;

    protected $fillable = ['first_name', 'last_name', 'start_date', 'end_date', 'social_security_number', 'citizen_number'];
    protected $appends = ['full_name'];
    protected $dates = ['start_date', 'end_date'];
    protected $searchable = ['first_name', 'last_name'];

    public function leaves(): HasMany
    {
        return $this->hasMany(Leave::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function scopeSearch($query, $search)
    {
        $terms = $this->splitName($search);

        foreach ($terms as $term) {
            $query->where(function ($query) use ($term) {
                $query->where('first_name', 'like', '%' . $term[0] . '%')
                    ->orWhere('last_name', 'like', '%' . $term[1] . '%');
            });
        }
    }
}
