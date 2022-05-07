<?php
    include('include/entete.inc.php');
    session_destroy();
    echo '<script>location.href=".";</script>';
    // Libération de la mémoire
    $result->close();
    $conn->close();
?>