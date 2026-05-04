<?php
$index = $_GET['index'] ?? -1;

if ($index === -1 || !is_numeric($index)) {
header("Location: index.php");
exit();
}

$index = (int)$index;
$file = "data.json";

if (file_exists($file)) {
$data = file_get_contents($file);
$games = json_decode($data, true);

if (is_array($games) && isset($games[$index])) {
$game = $games[$index];

// Delete associated image file if it exists
if (!empty($game['picture'])) {
$imagePath = 'uploads/' . $game['picture'];
if (file_exists($imagePath)) {
unlink($imagePath);
}
}

// Remove the game from the array
array_splice($games, $index, 1);

// Save the updated data
file_put_contents($file, json_encode($games, JSON_PRETTY_PRINT));
}
}

header("Location: index.php");
exit();
?>