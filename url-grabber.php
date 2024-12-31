<?php
ini_set('memory_limit', '10G');  // Increase to 2GB
$baseFolder = basename(getcwd()); // Get the base folder name
$currentDirectory = __DIR__; // Get the current directory

// Recursive function to get all files in a directory and its subdirectories
function getAllFiles($directory) {
    $allFiles = [];
    $items = scandir($directory);

    foreach ($items as $item) {
        if ($item === '.' || $item === '..'|| $item === '.git') {
            continue; // Skip special directories
        }

        $path = $directory . DIRECTORY_SEPARATOR . $item;

        if (is_file($path)) {
            $allFiles[] = $path; // Add file to the list
        } elseif (is_dir($path)) {
            $allFiles = array_merge($allFiles, getAllFiles($path)); // Recurse into subdirectories
        }
    }

    return $allFiles;
}

// Get all files from the current directory and its subdirectories
$files = getAllFiles($currentDirectory);
$a=1;
// Print the list of files with their GitHub paths
foreach ($files as $file) {
    echo $a;
    // Create a relative path for GitHub URLs
    $relativePath = str_replace($currentDirectory . DIRECTORY_SEPARATOR, '', $file);
    // echo "https://bitbucket.org/insight-hub/$baseFolder/src/main/$relativePath<br>";
    echo "https://github.com/divanaditi/$baseFolder/blob/main/$relativePath<br>";
    $a++;
}
?>

