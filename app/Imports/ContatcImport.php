<?php

namespace App\Imports;

use App\Models\Contact;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Validators\Failure;

class ContatcImport implements ToCollection, WithHeadingRow,  WithValidation,SkipsOnFailure
{
    use Importable,SkipsFailures;



    public function collection(Collection $rows)
    {
        // dd($rows);
        foreach ($rows as $row) {


            Contact::insertOrIgnore([
                //
                'title' => $row['salutation'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'email' => $row['work_e_mail'],
                'work_phone' => $row['work_phone'],
                'personal_phone' => $row['mobile'],
                'company' => $row['company'],
                'job_title' => $row['position'],
                'country' => $row['country'],
                'source' => $row['source'],
            ]);
        }
    }
    public function rules(): array
    {
        return [
            'work_e_mail' => [
                'required',
                 'regex:/(.+)@(.+)\.(.+)/i',
                // Rule::unique('contacts')->ignore($row['work_e_mail'], 'id')
            ]
            //...
        ];

    }
    public function customValidationAttributes()
    {
        return ['work_e_mail' => '( Work E-mail )'];
    }
    public function customValidationMessages()
    {
        return [
            'work_e_mail.regex' => ':attribute field in not an email format',
        ];
    }

    // public function onFailure(Failure ...$failures)
    // {
    //     // Handle the failures how you'd like.
    //     foreach ($failures as $failure) {
    //         file_put_contents('txt.txt',$failure->row());

    //       }
    //       return $failures;

    // }

}
