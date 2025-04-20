<?php

function Show($Array)
{
    echo "<pre>";
    print_r($Array);
    echo "</pre>";
}

function showAll()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    echo '<style>
        body { font-family: Consolas, monospace; background: #111; color: #eee; padding: 20px; }
        h2 { color: #4AF; border-bottom: 1px solid #444; margin-top: 30px; }
        pre { background: #222; padding: 10px; border-radius: 5px; overflow: auto; }
    </style>';

    $sections = [
        '$_GET'     => $_GET,
        '$_POST'    => $_POST,
        '$_REQUEST' => $_REQUEST,
        '$_FILES'   => $_FILES,
        '$_COOKIE'  => $_COOKIE,
        '$_SESSION' => $_SESSION,
        '$_SERVER'  => $_SERVER,
        '$_ENV'     => $_ENV,
        'getallheaders()' => function_exists('getallheaders') ? getallheaders() : 'getallheaders() not supported on this server.',
        'php://input (raw)' => file_get_contents('php://input'),
        'Included Files' => get_included_files(),
        'Memory Usage' => [
            'Current' => memory_get_usage(),
            'Peak' => memory_get_peak_usage()
        ]
    ];

    foreach ($sections as $title => $data) {
        echo "<h2>{$title}</h2>";
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

    die(); // Stop further script execution
}

function redirect($path)
{
    //echo ROOT;
	header("Location: " . BASE_URL."/".$path);
	die;
}