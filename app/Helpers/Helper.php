<?php

namespace App\Helpers;

use App\Models\Contact;

class Helper
{

    public  static function parser($email, $content, $field_data = [], $tracker = 'anana')
    {
        if (empty($field_data)) {
            $contact = Contact::where('email', $email)->first();
            if ($contact) {
                $array = array(
                    '{{ First Name }}' => $contact->first_name,
                    '{{ Last Name }}' => $contact->last_name,
                    '{{ Title }}' => $contact->title,
                    '{{ Job Title }}' => $contact->job_title,
                    '{{ Email }}' => $contact->email,
                    '%7B%7B%20Email%20%7D%7D' => $contact->email,
                    '{{ Work Phone }}' => $contact->work_phone,
                    '{{ Traker }}' => $tracker,
                    '%7B%7B%20Traker%20%7D%7D' => $tracker,
                );
                $result = str_replace(array_keys($array), array_values($array), $content);
                return $result;
            }
        } else {
            $fields = [];
            foreach ($field_data as $key => $value) {
                // Change the key format by wrapping it with {{ and }}
                $newKey = "{{ $key }}";

                // Assign the new key-value pair to the new array
                $fields[$newKey] = $value;
            }
            $fields['{{ Traker }}'] = $tracker;
            $fields['%7B%7B%20Traker%20%7D%7D'] = $tracker;
            $result = str_replace(array_keys($fields), array_values($fields), $content);
            // print("field_data\n");
            // print_r($field_data);
            // print("fields\n");
            // print_r($fields);
            return $result;
        }

        return $content;
    }
}
