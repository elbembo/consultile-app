<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('statusBadg')) {
    function statusBadg($status, $classes = null)
    {
        $color = '#6d80a2';

        switch ($status) {
            case 'draft':
                $color =  "#6d80a2";
                break;
            case 'processing':
                $color =  "#52ab4a";
                break;
            case 'pending':
                $color =  "#c3c249";
                break;
            case 'completed':
                $color =  "#9ccaff";
                break;
            case 'canceled':
                $color =  "#b80505";
                break;
        }
        return '<span class="badge ' . $classes . '" style="background-color:' . $color . ';">' . $status . '</span>';
    }
}
if (!function_exists('priority')) {
    function priority($priority = 1)
    {
        switch ($priority) {
            case 1:
                $priority =  "High";
                break;
            case 2:
                $priority =  "Normal";
                break;
            case 3:
                $priority =  "Low";
                break;
        }
        return $priority;
    }
}
if (!function_exists('secret')) {
    function secret($secret)
    {
        if(Auth::user()->hasAnyPermission(['secret.contacts'])){
            return $secret;
        }else{
            if(preg_match('/\b[\w\.-]+@[\w\.-]+\.\w{2,6}\b/',$secret)){
                return preg_replace('/(.).(?=..*@)/', '*', trim($secret));
            }else{
                return preg_replace('/(?<=...).(?=.*...)/', '*', $secret);
            }
        }

    }
}
if (!function_exists('updateDotEnv')) {
    function updateDotEnv($key, $newValue, $delim = '')
    {

        $path = base_path('.env');
        // get old value from current env
        $oldValue = env($key);

        // was there any change?
        if ($oldValue === $newValue) {
            return;
        }

        // rewrite file content with changed data
        if (file_exists($path)) {
            // replace current value with new value
            file_put_contents(
                $path,
                str_replace(
                    $key . '=' . $delim . $oldValue . $delim,
                    $key . '=' . $delim . $newValue . $delim,
                    file_get_contents($path)
                )
            );
        }
    }
}
if (!function_exists('ranlor')){
    function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    function ranlor() {
        return '#'.random_color_part() . random_color_part() . random_color_part();
    }
}
