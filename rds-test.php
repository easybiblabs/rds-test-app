<?php

$default_config = [
    'RDS_TEST_HOST' => 'localhost',
    'RDS_TEST_PORT' => '3306',
    'RDS_TEST_DBNAME' => '',
    'RDS_TEST_USERNAME' => '',
    'RDS_TEST_PASSWORD' => '',
];
$config = [];

try {
    $deploy_config = include "./.deploy_configuration.php";
    $settings = $deploy_config['settings'];
} catch (Exception $e) {
    echo 'Can not open configuration: ', $e->getMessage(), "\n";
    $settings = [];
}

foreach($settings as $key => $value){
    $exploded = explode('_', $key);
    if($exploded[0] == 'RDS' and $exploded[1] == "TEST"){
        $config += [$key => $value];
    }
}

$config = array_merge($default_config, $config);

if ($config['RDS_TEST_DBNAME'] == "") {
    echo("If DBNAME is not set, PHP may only do a lazy connect and deliver false results.\n");
    die(1);
}

$host = $config['RDS_TEST_HOST'];
$port = $config['RDS_TEST_PORT'];
$dbname = $config['RDS_TEST_DBNAME'];
$username = $config['RDS_TEST_USERNAME'];
$password = $config['RDS_TEST_PASSWORD'];
$socket = ini_get('mysqli.default_socket');
$flags = null;
$max = 0;

$conn = mysqli_init();                                                                                                                                                                  

$start = microtime(true);
$conn->real_connect($host, $username, $password, $dbname, $port, $socket, $flags);
$conn->close();

$time = microtime(true) - $start;
if ($time > $max) {
        $max = $time;
        echo "$time\n";
}
