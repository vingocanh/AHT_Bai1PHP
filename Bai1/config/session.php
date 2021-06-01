<?php

session_start();

    class SessionUser{
         public static function setSession($key, $values){
             $_SESSION[$key] = $values;
         }

         public static function getSession($key){
            if(isset($_SESSION[$key])){
                return $_SESSION[$key];
            }else{
                return false;
            }
        }

         public static function huySession($key){
            if(isset($_SESSION[$key])){
                unset($_SESSION[$key]);
            }
         }
     }
?>