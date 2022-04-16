<?php
require 'function.php';

$id = $_GET["id"];

if (delete($id) > 0) {
    echo "
    <script>
        alert('data berhasil dihapus');
        document.location.href = 'index1.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('data gagal ditambahkan');
        document.location.href = 'index1.php';
    </script>
";
}