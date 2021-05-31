<?php
    function   connection(){
        $dbHost="localhost";
        $user="root";
        $pass="";
        $dbname="inventory_management";
         $conn= new mysqli($dbHost,$user,$pass,$dbname);
         return$conn;
    }
    function CloseConnect($cn){
        $cn->close();
    }
?>