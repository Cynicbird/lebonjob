<?php
    /**
     * Project Name : LeBonJob
     * Author : Paartheepan
     */
    function debug($variable){
        echo '<pre>' . print_r($variable, true) . '</pre>';
    }

    function str_random($length){
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

    function getUserState() {
        $state = "";
        if(isset($_SESSION['auth']->prenom)) {
            $state = "c"; // c'est un chomeur
        }else {
            $state = "e"; // c'est un entrepreneur
        }
        $_SESSION['state'] = $state;
    }

    function logged_only() {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['auth'])) {
            $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
            header('Location: login.php');
            exit();
        }
        getUserState();
    }

   