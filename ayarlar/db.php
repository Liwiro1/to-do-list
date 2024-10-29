<?php
try {
    $conn = mysqli_connect('localhost','root','','to_do_list') or die('connection failed');

    $DBConnection = new PDO("mysql:host=localhost;dbname=to_do_list;charset=utf8;",'root','');
    //echo 'Bağlantı başarılı';
}catch(PDOException $e){
    echo $e->getMessage();
}
?>