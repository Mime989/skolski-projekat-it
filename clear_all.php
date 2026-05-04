<?php
// Clear all games data
$file = "data.json";
if (file_exists($file)) {
unlink($file);
}

// Clear all uploaded images
$upload_dir = 'uploads/';
if (is_dir($upload_dir)) {
$files = glob($upload_dir . '*');
foreach ($files as $file) {
if (is_file($file)) {
unlink($file);
}
}
}

header("Location: index.php");
exit();
?>