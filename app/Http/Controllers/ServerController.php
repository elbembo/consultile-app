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
        return view('server', compact('envs'));
    }
    public function store(Request $request)
    {
        # code...
        if (!empty($request->env)) {
            if ($request->env == "local") {
                // setEnv('APP_ENV','local');
                // setEnv('APP_DEBUG',"true");
                file_put_contents(app()->environmentFilePath(), str_replace(
                    'APP_ENV' . '=' . 'production',
                    'APP_ENV' . '=' . 'local' ,
                    file_get_contents(app()->environmentFilePath())
                ));
                file_put_contents(app()->environmentFilePath(), str_replace(
                    'APP_DEBUG' . '=' . 'false',
                    'APP_DEBUG' . '=' . 'true' ,
                    file_get_contents(app()->environmentFilePath())
                ));
                return response()->json(['state' => true, 'msg' => 'local']);
            }
            if ($request->env == "production") {
                // setEnv('APP_ENV','production');
                // setEnv('APP_DEBUG',"false");
                file_put_contents(app()->environmentFilePath(), str_replace(
                    'APP_ENV' . '=' . 'local',
                    'APP_ENV' . '=' . 'production' ,
                    file_get_contents(app()->environmentFilePath())
                ));
                file_put_contents(app()->environmentFilePath(), str_replace(
                    'APP_DEBUG' . '=' . 'true',
                    'APP_DEBUG' . '=' . 'false' ,
                    file_get_contents(app()->environmentFilePath())
                ));
                return response()->json(['state' => true, 'msg' => 'production']);
            }

        }
    }
}
