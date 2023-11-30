<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class UsersExport implements FromCollection,WithHeadings,WithMapping
{

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::all();

    }
    /**
     * Returns headers for report
     * @return array
     */
    public function headings(): array {
        return [
            'id',
            'name',
            'email',
            "password",
            "phone",
            "role",
            "create_at",
            "update_at",
            "deleted_at"

        ];
    }

    public function map($user): array {
        return [
            $user->id,
            $user->name,
            $user->email,
            '',
            $user->phone,
            $user->role,
            $user->created_at,
            $user->updated_at,
            $user->deleted_at,
        ];
    }
}
