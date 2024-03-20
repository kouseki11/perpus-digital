<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::get()->map(function ($user) {
            $role = 'Loaner'; // Default role if none found
            
            if ($user->hasRole('administrator')) {
                $role = 'Administrator';
            } elseif ($user->hasRole('staff')) {
                $role = 'Staff';
            }
            
            return [
                'Name' => $user->name,
                'Username' => $user->username,
                'Email' => $user->email,
                'Role' => $role,
                'Address' => $user->address
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Name',
            'Username',
            'Email',
            'Role',
            'Address'
        ];
    }
}
