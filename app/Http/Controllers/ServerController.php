<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServerController extends Controller
{
    //
    public function index()
    {
        # code...
        $path = base_path('.env');
        // get old value from current env

        // was there any change?

        // rewrite file content with changed data
        $envs = [];
        if (file_exists($path)) {
            // replace current value with new value
            $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0) {
                    continue;
                }
                list($name, $value) = explode('=', $line, 2);
                $name = trim($name);
                $value = trim($value);
                $envs[$name] = $value;
            }

        }
        return view('server',compact('envs'));
    }
}
