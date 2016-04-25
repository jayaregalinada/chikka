<?php
    $arr_post_body = array(
        "message_type" => "SEND",
        "mobile_number" => "639181234567",
        "shortcode" => "29290123456",
        "message_id" => "12345678901234567890123456789012",
        "message" => urlencode("Welcome to My Service!"),
        "client_id" => "1e6d92a6e8794a7bb6aea67f008420e56a0272dfb21047369dc1ea0c9c8f8a19",
        "secret_key" => "502f3b2ecce940f5b750dab07bf6b222de86f6e270a6427e9a0ea6b194bb4bdc"
    );

    $query_string = "";
    foreach ($arr_post_body as $key => $frow) {
        $query_string .= '&'.$key.'='.$frow;
    }

    $URL = "https://post.chikka.com/smsapi/request";

    $curl_handler = curl_init();
    curl_setopt($curl_handler, CURLOPT_URL, $URL);
    curl_setopt($curl_handler, CURLOPT_POST, count($arr_post_body));
    curl_setopt($curl_handler, CURLOPT_POSTFIELDS, $query_string);
    curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl_handler);
    curl_close($curl_handler);

    exit(0);
