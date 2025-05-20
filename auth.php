<?php
    require_once 'dbconfig.php';
    session_start();

    function checkAuth() {
        if(isset($_SESSION['_agora_user_id'])) {
            return $_SESSION['_agora_user_id'];
        } else 
            return 0;
    }
?>