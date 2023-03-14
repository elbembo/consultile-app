<?php
namespace App\Helpers;

use App\Models\Contact;
class Helper {

    public  static function parser($email,$content,$tracker = 'anana')
    {
        $contact = Contact::where('email',$email)->first();
        if($contact){
            $array = array(
                '{{ First Name }}' => $contact->first_name,
                '{{ Last Name }}' => $contact->last_name,
                '{{ Title }}' => $contact->title,
                '{{ Job Title }}' => $contact->job_title,
                '{{ Email }}' => $contact->email,
                '{{ Work Phone }}' => $contact->work_phone,
                '{{ Tracker }}' => $tracker,
            );
            $result = str_replace(array_keys($array), array_values($array), $content);
            return $result;
        }
        return $content;
    }
}


