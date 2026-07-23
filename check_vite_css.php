<?php
$ch = curl_init('http://127.0.0.1:5173/resources/css/app.css');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 3);
$css = curl_exec($ch);
curl_close($ch);

if ($css === false || empty($css)) {
    echo 'Vite dev server not responding' . PHP_EOL;
    exit;
}

$hasBgHero = strpos($css, 'bg-hero') !== false;
$hasDamascus = strpos($css, 'damascus-bg') !== false;
$hasPngRef = strpos($css, 'damascus-bg.png') !== false;
$hasJpgRef = strpos($css, 'damascus-bg.jpg') !== false;

echo 'bg-hero: ' . ($hasBgHero ? 'FOUND' : 'MISSING') . PHP_EOL;
echo 'damascus-bg: ' . ($hasDamascus ? 'FOUND' : 'MISSING') . PHP_EOL;
echo 'reference .png: ' . ($hasPngRef ? 'FOUND' : 'MISSING') . PHP_EOL;
echo 'reference .jpg: ' . ($hasJpgRef ? 'FOUND (STALE!)' : 'MISSING') . PHP_EOL;
