<?php
function execPrint($command) {
    $result = array();
    exec($command, $result);
    // print("<pre>");
    // foreach ($result as $line) {
    //     print($line . "\n");
    // }
    // print("</pre>");
    return $result ;
}
$data = execPrint("git pull");
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
