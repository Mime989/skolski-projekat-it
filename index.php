<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Game Logger App</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h1>Game Logger App</h1>
<div class="theme-selector">
<label for="theme-select">Choose Theme:</label>
<select id="theme-select">
<option value="light">Light</option>
<option value="dark">Dark</option>
<option value="colorful">Colorful</option>
<option value="custom">Custom</option>
</select>
<div id="custom-theme-controls" style="display: none; margin-top: 10px;">
<label for="primary-color">Primary Color:</label>
<input type="color" id="primary-color" value="#2d6cdf">
<label for="background-color">Background Color:</label>
<input type="color" id="background-color" value="#f4f6f8">
<label for="text-color">Text Color:</label>
<input type="color" id="text-color" value="#333">
</div>
</div>
<p class="subtitle">Log your favorite games with details and images.</p>

<form action="save.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
<label for="name">Game Name</label>
<input type="text" id="name" name="name" placeholder="Enter game name">

<label for="genre">Genre</label>
<input type="text" id="genre" name="genre" placeholder="Enter game genre">

<label for="platforms">Platforms</label>
<input type="text" id="platforms" name="platforms" placeholder="Enter platforms (comma-separated)">

<label for="release_year">Release Year</label>
<input type="number" id="release_year" name="release_year" placeholder="Enter release year" min="1950" max="2030">

<label for="picture">Game Cover Image</label>
<input type="file" id="picture" name="picture" accept="image/*">

<button type="submit">Add Game</button>
</form>

<h2>Game Library</h2>
<div style="margin-bottom: 15px;">
<button onclick="clearAllGames()" style="background-color: #e74c3c; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer;">Clear All Games</button>
</div>
<div class="table-container">
<?php
$file = "data.json";

if (file_exists($file)) {
$data = file_get_contents($file);
$games = json_decode($data, true);

if (!empty($games)) {
echo "<table>";
echo "<thead><tr><th>Game Name</th><th>Genre</th><th>Platforms</th><th>Release Year</th><th>Cover</th><th>Actions</th></tr></thead>";
echo "<tbody>";
foreach ($games as $index => $game) {
$safeName = htmlspecialchars($game["name"]);
$safeGenre = htmlspecialchars($game["genre"]);
$safePlatforms = htmlspecialchars($game["platforms"]);
$safeYear = htmlspecialchars($game["release_year"]);
$safePicture = htmlspecialchars($game["picture"] ?? "");

$imageHtml = $safePicture ? "<img src='uploads/" . $safePicture . "' alt='" . $safeName . "' style='max-width: 80px; max-height: 80px;'>" : "No image";

echo "<tr>";
echo "<td>$safeName</td>";
echo "<td>$safeGenre</td>";
echo "<td>$safePlatforms</td>";
echo "<td>$safeYear</td>";
echo "<td>$imageHtml</td>";
echo "<td><button onclick=\"deleteGame($index)\" class=\"delete-btn\">Delete</button></td>";
echo "</tr>";
}
echo "</tbody></table>";
} else {
echo "<p>No games logged yet.</p>";
}
} else {
echo "<p>No games logged yet.</p>";
}
?>
</div>
</div>

<script src="script.js"></script>
</body>
</html>
