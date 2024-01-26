<?php


namespace App\Exports;


use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;

class InvoicesExport implements FromCollection
{
    public function collection()
    {
        return User::all();
    }
}
