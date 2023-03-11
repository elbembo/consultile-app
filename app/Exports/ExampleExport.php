<?php

namespace App\Exports;

use App\Models\Contact;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
class ExampleExport implements FromArray, Responsable
{
    use Exportable;

    /**
    * It's required to define the fileName within
    * the export class when making use of Responsable.
    */
    private $fileName = 'import_contacts_example.xlsx';

    /**
    * Optional Writer Type
    */
    private $writerType = Excel::XLSX;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        return [
            ['Salutation',
            'First Name',
            'Last Name',
            'Work E-mail',
            'Work Phone',
            'Mobile',
            'Company',
            'Position',
            'Country',
            'Source',
            ]
        ];
    }
}
