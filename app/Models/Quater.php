<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quater extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre",
        "ubicacion"
    ];

    public function soldiers()
    {
        return $this->hasMany(Soldier::class, 'quarter_id');
    }

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['nombre'])) {
            $query->where('nombre', $filters['nombre']);
        }

        if (isset($filters['ubicacion'])) {
            $query->where('ubicacion', $filters['ubicacion']);
        }

        if (isset($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('nombre', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('ubicacion', 'like', '%' . $filters['search'] . '%');
            });
        }

        return $query;
    }
}
