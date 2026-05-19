# Ejemplos de Uso de los Scopes API

Todos los modelos ahora tienen los siguientes scopes para funcionar como API JSON:

## Scopes Disponibles

### 1. **Included** - Cargar relaciones
Incluye relaciones definidas en la lista blanca `$allowIncluded`.

```
?included=army_corp,services
```

**Modelos y relaciones permitidas:**
- `Army_corp`: `soldiers`
- `Company`: `soldiers`
- `Quater`: `soldiers`
- `Service`: `soldiers`
- `Soldier`: `army_corp`, `quarter`, `company`, `services`

---

### 2. **Filter** - Filtrar resultados
Filtra por campos definidos en `$allowFilter` usando LIKE.

```
?filter[nombre]=Juan&filter[grado]=3
```

**Campos permitidos por modelo:**
- `Army_corp`: `id`, `denominacion`
- `Company`: `id`, `actividad`
- `Quater`: `id`, `nombre`, `ubicacion`
- `Service`: `id`, `actividad_servicio`
- `Soldier`: `id`, `nombre`, `apellido`, `grado`

---

### 3. **Sort** - Ordenar resultados
Ordena por campos definidos en `$allowSort`. Usa `-` al inicio para descendente.

```
?sort=nombre,-grado
```

**Campos ordenables:**
- `Army_corp`: `id`, `denominacion`
- `Company`: `id`, `actividad`
- `Quater`: `id`, `nombre`, `ubicacion`
- `Service`: `id`, `actividad_servicio`
- `Soldier`: `id`, `nombre`, `apellido`, `grado`

---

### 4. **PerPage** - Paginación
Pagina los resultados. Si no se especifica, retorna todos.

```
?perPage=15
```

---

## Ejemplos de Rutas

Asumiendo que tienes un controlador `SoldierController`:

```php
// routes/api.php
Route::apiResource('soldiers', SoldierController::class);
Route::apiResource('army-corps', ArmyCorpController::class);
Route::apiResource('companies', CompanyController::class);
Route::apiResource('quaters', QuaterController::class);
Route::apiResource('services', ServiceController::class);
```

---

## Ejemplos de Queries en el Controlador

```php
<?php

namespace App\Http\Controllers\Api;

use App\Models\Soldier;
use Illuminate\Http\Request;

class SoldierController
{
    public function index()
    {
        return Soldier::query()
            ->included()
            ->filter()
            ->sort()
            ->getOrPaginate();
    }
}
```

---

## Ejemplos de Requests HTTP

### Obtener todos los Soldiers
```
GET /api/soldiers
```

### Obtener Soldiers con sus relaciones
```
GET /api/soldiers?included=army_corp,company,services
```

### Filtrar Soldiers por nombre
```
GET /api/soldiers?filter[nombre]=Juan
```

### Filtrar y ordenar
```
GET /api/soldiers?filter[grado]=3&sort=-nombre
```

### Filtrar, ordenar, incluir relaciones y paginar
```
GET /api/soldiers?filter[nombre]=Juan&sort=id&included=army_corp,services&perPage=10
```

### Obtener Quaters con sus Soldiers
```
GET /api/quaters?included=soldiers&perPage=5
```

### Filtrar Army Corps por denominación
```
GET /api/army-corps?filter[denominacion]=infanteria
```

---

## Respuesta JSON esperada

```json
{
  "data": [
    {
      "id": 1,
      "nombre": "Juan",
      "apellido": "García",
      "grado": 3,
      "army_corp_id": 1,
      "quarter_id": 1,
      "company_id": 1,
      "created_at": "2026-05-19T21:16:13.000000Z",
      "updated_at": "2026-05-19T21:16:13.000000Z",
      "army_corp": {
        "id": 1,
        "denominacion": "Infantería",
        "created_at": "2026-05-19T21:00:00.000000Z",
        "updated_at": "2026-05-19T21:00:00.000000Z"
      },
      "services": [
        {
          "id": 1,
          "actividad_servicio": "Vigilancia",
          "created_at": "2026-05-19T21:00:00.000000Z",
          "updated_at": "2026-05-19T21:00:00.000000Z",
          "pivot": {
            "soldier_id": 1,
            "service_id": 1
          }
        }
      ]
    }
  ],
  "links": {
    "first": "http://localhost/api/soldiers?page=1",
    "last": "http://localhost/api/soldiers?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "path": "http://localhost/api/soldiers",
    "per_page": 15,
    "to": 10,
    "total": 10
  }
}
```

---

## Notas de Seguridad

- Los campos `$allowFilter`, `$allowSort`, y `$allowIncluded` actúan como **listas blancas** para prevenir que usuarios exponga información sensible
- Solo los campos en estas listas pueden ser filtrados, ordenados o incluidos
- Intenta filtrar/ordenar/incluir campos no autorizados serán **ignorados silenciosamente**

