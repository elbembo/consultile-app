<?php

namespace App\Exports;

use App\Models\Contact;
use App\Models\ContactGroupe;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;

class SMSExport implements FromQuery
{
    use Exportable;
    private $day;
    public function __construct(string $date)
    {
        $this->day =  Carbon::createFromFormat('Y-m-d', $date);
    }

    public function query()
    {
        // dd(Contact::whereDate('created_at',">=", $this->day));
        $fromgroup = ContactGroupe::where('group_name','Database')->pluck('contact_id');
//         $ids = [];
// // foreach(){

// // }
//         dump($fromgroup);
        return Contact::whereNotIn('id',$fromgroup)->whereDate('created_at',">=", $this->day);
    }
}
