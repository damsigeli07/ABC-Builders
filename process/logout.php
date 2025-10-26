<?php
    session_start();
    session_unset();
    session_destroy();
    header('Location: /material_management_system');
?>