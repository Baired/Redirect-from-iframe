<?php

$apiURL = 'cache-api.php';

$ip = $_SERVER['REMOTE_ADDR'];

if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
}

// Check for GET parameter 'type'
if (isset($_GET['type'])) {
    if ($_GET['type'] == 'write') {
        // If 'type' is 'write', create a new cache file only if 'url' parameter exists
        if (isset($_GET['url'])) {
            $cacheFile = './cache/' . md5($ip) . '.txt';
            file_put_contents($cacheFile, $_GET['url']);
        } else {
            // Return an error if 'url' parameter is not set
            echo json_encode([
                "status" => "bad", 
                "error" => "Parameter 'url' is not set"
            ]);

            exit;
        }
    } elseif ($_GET['type'] == 'view') {
        // If 'type' is 'view', check for the existence of cache file and output its content if the file exists
        $cacheFile = './cache/' . md5($ip) . '.txt';
        if (file_exists($cacheFile)) {
            $data = file_get_contents($cacheFile);
            echo json_encode([
                "status" => "ok", 
                "result" => $data
            ]);
            // Delete cache file after usage
            unlink($cacheFile);
        } else {
            // Return an error if cache file is not found
            echo json_encode([
                "status" => "bad", 
                "error" => "Cache file not found"
            ]);

            exit;
        }
    } elseif($_GET['type'] == 'javascript') {
        header('Content-Type: text/javascript');

        echo "
        function sendRequest() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '".$apiURL."?type=view');
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send();
        
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
        
                    if (response.status === 'ok') {
                        console.log(response.status)
                        var result = response.result;
                        window.location.href = result;
                    }
                } else {}
            };
        }; setInterval(sendRequest, 500);
        ";

    } else {
        // Return an error if 'type' parameter is not recognized
        echo json_encode([
            "status" => "bad", 
            "error" => "Parameter 'type' is set incorrectly"
        ]);

        exit;
    }
} else {
    // Return an error if 'type' parameter is not set
    echo json_encode([
        "status" => "bad", 
        "error" => "Parameter 'type' is not set"
    ]);

    exit;
}

?>
