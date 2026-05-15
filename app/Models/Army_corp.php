<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Army_corp extends Model
{
    use HasFactory;

    protected $fillable = [
        "denominacion"
    ];

    public function soldiers()
    {
        return $this->hasMany(Soldier::class, 'army_corp_id');
    }

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['denominacion'])) {
            $query->where('denominacion', $filters['denominacion']);
        }

        if (isset($filters['search'])) {
            $query->where('denominacion', 'like', '%' . $filters['search'] . '%');
        }

        return $query;
    }
}
