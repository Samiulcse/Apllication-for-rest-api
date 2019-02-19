<?php

function callAPI($method, $url, $data, $headers = false)
{
    $curl = curl_init();

    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }

            break;

        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }

            break;
        case "DELETE":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            break;
    }

    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HEADER, 0);

    // EXECUTE:
    $result = curl_exec($curl);

    if (!$result) {
        die("Connection Failure");
    }
    curl_close($curl);
    return $result;
}
