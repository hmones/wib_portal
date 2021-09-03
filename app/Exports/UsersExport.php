<?php

namespace App\Exports;

use App\Http\Resources\UserResource;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function collection()
    {
        return UserResource::collection($this->users);
    }

    public function headings(): array
    {
        return [
            'id',
            'title',
            'name',
            'email',
            'image',
            'gender',
            'birth_year',
            'bio',
            'phone',
            'country',
            'city',
            'postal_code',
            'education',
            'mena_diaspora',
            'business_association',
            'profile_completion',
            'last_login',
            'created_at',
        ];
    }
}
