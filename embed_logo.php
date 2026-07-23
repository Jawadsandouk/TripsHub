<?php
$path = 'D:\coding\Gilgamesh\Laravel\Trips\public\images\logo1.png';
$data = file_get_contents($path);
$base64 = base64_encode($data);
$dataUri = 'data:image/png;base64,' . $base64;

// Update the email template
$emailPath = 'D:\coding\Gilgamesh\Laravel\Trips\resources\views\emails\booking-ticket.blade.php';
$content = file_get_contents($emailPath);

// Replace the asset() call with the data URI
$old = "{{ asset('images/logo1.png') }}";
$new = "'$dataUri'";

$content = str_replace($old, $new, $content);
file_put_contents($emailPath, $content);
echo "Email template updated with embedded logo\n";
echo "Base64 size: " . strlen($base64) . " chars\n";
