<?php

namespace App\Exports;

use App\Http\Resources\EntityResource;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EntitiesExport implements FromCollection, WithHeadings
{
    protected $entities;

    public function __construct($entities)
    {
        $this->entities = $entities;
    }

    public function collection()
    {
        return EntityResource::collection($this->entities);
    }

    public function headings(): array
    {
        return [
            'business type',
            'name',
            'additional Name',
            'image Link',
            'entity type',
            'founding year',
            'primary address',
            'secondary address',
            'primary email',
            'secondary email',
            'phone',
            'fax',
            'legal form',
            'activity',
            'entity size',
            'turn over',
            'balance sheet',
            'revenue',
            'number of employees',
            'number of students',
            'ecommerce link',
            'ecommerce rating',
            'owned by',
            'created at'
        ];
    }
}
