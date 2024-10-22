<?php

namespace App\Imports;

use App\Models\CampaignContacts;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DirectContactsImport implements ToModel, WithHeadingRow
{
    use Importable,SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $fields = [];
    private $name;
    public $code;
    private $contact;
    public function  __construct($name)
    {
        $this->name = $name;
        $this->code = str()->random();
    }
    public function model(array $row)
    {
        // $fields = [];
        // foreach($row as $key => $value){
        //     if($key != 'email')
        //         array_push($fields,$row);

        // }



        return new CampaignContacts([
            //
            'email' => $row['email'],
            'name' => $this->name,
            'code' => $this->code,
            'fields_data' => $row
        ]);
    }
}
