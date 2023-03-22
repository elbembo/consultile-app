<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('php://input');
    function execPrint($command)
    {
        $result = array();
        exec($command, $result);
        // print("<pre>");
        // foreach ($result as $line) {
        //     print($line . "\n");
        // }
        // print("</pre>");
        return $result;
    }
    $data[] = execPrint("git pull");
    $data[] = execPrint("php82 /home/u2043-oclzxdlfwlcl/www/app.consultile.com/public_html/artisan cache:clear");
    $data[] = execPrint("php82 /home/u2043-oclzxdlfwlcl/www/app.consultile.com/public_html/artisan route:clear");
    $data[] = execPrint("php82 /home/u2043-oclzxdlfwlcl/www/app.consultile.com/public_html/artisan view:clear");
    $data[] = execPrint("php82 /home/u2043-oclzxdlfwlcl/www/app.consultile.com/public_html/artisan config:clear");
    $data[] = execPrint("php82 /home/u2043-oclzxdlfwlcl/www/app.consultile.com/public_html/artisan event:clear");
    $data[] = execPrint("php82 /home/u2043-oclzxdlfwlcl/www/app.consultile.com/public_html/artisan optimize:clear");
    $data[] = execPrint("php82 /home/u2043-oclzxdlfwlcl/www/app.consultile.com/public_html/artisan route:cache");
    $data[] = execPrint("php82 /home/u2043-oclzxdlfwlcl/www/app.consultile.com/public_html/artisan view:cache");
    $data[] = execPrint("php82 /home/u2043-oclzxdlfwlcl/www/app.consultile.com/public_html/artisan config:cache");
    $data[] = execPrint("php82 /home/u2043-oclzxdlfwlcl/www/app.consultile.com/public_html/artisan event:cache");
    $data[] = execPrint("php82 /home/u2043-oclzxdlfwlcl/www/app.consultile.com/public_html/artisan optimize");
    $data[] = __DIR__;
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}else{
    http_response_code(405);
}
