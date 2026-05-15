<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        "actividad_servicio"
    ];

    public function soldiers()
    {
        return $this->belongsToMany(Soldier::class, 'services_soldiers');
    }

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['actividad_servicio'])) {
            $query->where('actividad_servicio', $filters['actividad_servicio']);
        }

        if (isset($filters['search'])) {
            $query->where('actividad_servicio', 'like', '%' . $filters['search'] . '%');
        }

        return $query;
    }
}
