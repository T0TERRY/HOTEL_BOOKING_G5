<?php 
try{
    //host
    define("HOST","localhost");

    //dbname
    define("DBNAME","hotel-booking");

    //USER
    define("USER","root");

    //password
    define("PASS","");

    $conn = new PDO("mysql:host=".HOST.";dbname=".DBNAME."",USER,PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e){
    echo $e->getMessage();
}
?>