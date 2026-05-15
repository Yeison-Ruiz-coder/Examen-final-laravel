<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        "actividad"
    ];

    public function soldiers()
    {
        return $this->hasMany(Soldier::class, 'company_id');
    }

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['actividad'])) {
            $query->where('actividad', $filters['actividad']);
        }

        if (isset($filters['search'])) {
            $query->where('actividad', 'like', '%' . $filters['search'] . '%');
        }

        return $query;
    }
}
