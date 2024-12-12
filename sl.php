<?php

$target = __DIR__ . '/storage/app/public'; // Целевая папка
$link = __DIR__ . '/public/storage'; // Место для символической ссылки

if (file_exists($link)) {
    echo "The symbolic link already exists.";
} elseif (symlink($target, $link)) {
    echo "Symbolic link created successfully.";
} else {
    echo "Failed to create symbolic link.";
}
