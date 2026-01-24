<?php 
    return [
        // 'host' => 'localhost',
        'host' => $_ENV['HOST'],
        'database' => $_ENV['DB'],
        'username' => $_ENV['USER'],
        'password' => $_ENV['PASS']
    ]
?>