<?php
$name = trim($_POST["name"] ?? "");
$genre = trim($_POST["genre"] ?? "");
$platforms = trim($_POST["platforms"] ?? "");
$release_year = trim($_POST["release_year"] ?? "");

if ($name === "" || $genre === "" || $platforms === "" || $release_year === "") {
header("Location: index.php");
exit();
}

// Handle file upload
$picture_filename = "";
if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
mkdir($upload_dir, 0755, true);
}

$original_filename = basename($_FILES['picture']['name']);
$file_extension = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));

// Generate unique filename
$picture_filename = uniqid() . '.' . $file_extension;
$upload_path = $upload_dir . $picture_filename;

// Check if file is an image
$allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
if (in_array($file_extension, $allowed_types)) {
if (move_uploaded_file($_FILES['picture']['tmp_name'], $upload_path)) {
$picture_filename = $picture_filename;
} else {
$picture_filename = "";
}
} else {
$picture_filename = "";
}
}

$file = "data.json";
if (file_exists($file)) {
$data = file_get_contents($file);
$games = json_decode($data, true);
if (!is_array($games)) {
$games = [];
}
} else {
$games = [];
}

$newGame = [
"name" => $name,
"genre" => $genre,
"platforms" => $platforms,
"release_year" => $release_year,
"picture" => $picture_filename
];

$games[] = $newGame;
file_put_contents($file, json_encode($games, JSON_PRETTY_PRINT));
header("Location: index.php");
exit();
?>
