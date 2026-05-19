<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Soldier extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre",
        "apellido",
        "grado",
        "army_corp_id",
        "quarter_id",
        "company_id"
    ];

    // Listas blancas para seguridad en APIs
    protected $allowIncluded = ['army_corp', 'quarter', 'company', 'services'];
    protected $allowFilter = ['id', 'nombre', 'apellido', 'grado'];
    protected $allowSort = ['id', 'nombre', 'apellido', 'grado'];

    public function army_corp()
    {
        return $this->belongsTo(Army_corp::class, 'army_corp_id');
    }

    public function quarter()
    {
        return $this->belongsTo(Quater::class, 'quarter_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'services_soldiers');
    }

    /**
     * Scope para incluir relaciones de forma segura
     */
    public function scopeIncluded(Builder $query)
    {
        if (empty($this->allowIncluded) || empty(request('included'))) {
            return;
        }

        $relations = explode(',', request('included'));
        $allowIncluded = collect($this->allowIncluded);

        foreach ($relations as $key => $relationship) {
            if (!$allowIncluded->contains($relationship)) {
                unset($relations[$key]);
            }
        }

        $query->with($relations);
    }

    /**
     * Scope para filtrar por parámetros HTTP
     */
    public function scopeFilter(Builder $query)
    {
        if (empty($this->allowFilter) || empty(request('filter'))) {
            return;
        }

        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);

        foreach ($filters as $filter => $value) {
            if ($allowFilter->contains($filter)) {
                $query->where($filter, 'LIKE', '%' . $value . '%');
            }
        }
    }

    /**
     * Scope para ordenar resultados
     */
    public function scopeSort(Builder $query)
    {
        if (empty($this->allowSort) || empty(request('sort'))) {
            return;
        }

        $sortFields = explode(',', request('sort'));
        $allowSort = collect($this->allowSort);

        foreach ($sortFields as $sortField) {
            $direction = 'asc';

            if (substr($sortField, 0, 1) == '-') {
                $direction = 'desc';
                $sortField = substr($sortField, 1);
            }

            if ($allowSort->contains($sortField)) {
                $query->orderBy($sortField, $direction);
            }
        }
    }

    /**
     * Scope para obtener todos o paginar
     */
    public function scopeGetOrPaginate(Builder $query)
    {
        if (request('perPage')) {
            $perPage = intval(request('perPage'));

            if ($perPage) {
                return $query->paginate($perPage);
            }
        }

        return $query->get();
    }
}
