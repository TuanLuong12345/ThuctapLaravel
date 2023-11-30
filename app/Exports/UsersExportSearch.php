<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExportSearch implements FromCollection, WithHeadings, WithMapping
{
    protected $searchResultsAll;

    public function __construct($searchResultsAll)
    {
        $this->searchResultsAll = $searchResultsAll;
    }

    public function collection()
    {
        return $this->searchResultsAll;
    }

    public function headings(): array {
        // Tiêu đề cột trong file Excel
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
        // Dữ liệu từ mỗi bản ghi người dùng
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
