<?php
try {
    $message_type = $_POST["message_type"];
} catch (Exception $e) {
    echo "Error";
    exit(0);
}

if (strtoupper($message_type) == "OUTGOING") {
    try {
        // Retrieve the parameters from the body
        $message_id = $_POST["message_id"];
        $mobile_number = $_POST["mobile_number"];
        $shortcode = $_POST["shortcode"];
        $status = $_POST["status"];
        $timestamp = $_POST["timestamp"];
        $credits_cost = $_POST["credits_cost"];

        echo "Accepted";
        exit(0);
    } catch (Exception $e) {
        echo "Error";
        exit(0);
    }
} else {
    echo "Error";
    exit(0);
}
