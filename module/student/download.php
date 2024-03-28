<?php
if (isset($_GET['file_path'])) {
    $file_path = urldecode($_GET['file_path']);

    if (file_exists($file_path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file_path));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    } else {
        echo 'File not found.';
    }
} else {
    echo 'Invalid file path.';
}
?>
