<?php
$ch = curl_init('http://127.0.0.1:8002/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$html = curl_exec($ch);
curl_close($ch);

preg_match('/href="([^"]*app[^"]*\.css[^"]*)"/', $html, $css);
echo "CSS file: " . ($css[1] ?? 'NONE') . "\n";
echo "bg-hero class: " . (strpos($html, 'bg-hero') !== false ? 'FOUND' : 'MISSING') . "\n";
echo "damascus ref: " . (strpos($html, 'damascus') !== false ? 'FOUND' : 'MISSING') . "\n";

// Also check the built CSS for the damascus URL
$manifest = json_decode(file_get_contents('public/build/manifest.json'), true);
$cssFile = 'public/build/' . ($manifest['resources/css/app.css']['file'] ?? '');
echo "Manifest CSS: " . $cssFile . "\n";
$cssContent = file_get_contents($cssFile);
echo "damascus in built CSS: " . (strpos($cssContent, 'damascus-bg') !== false ? 'FOUND' : 'MISSING') . "\n";
