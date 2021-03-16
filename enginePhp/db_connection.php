<?php
    function OpenCon(){
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $db = 'db_lpd';

        $conn = new mysqli($dbhost,$dbuser,$dbpass,$db) or die('gagal buat koneksi karena : $s\n'.$conn -> error);

        return $conn;
    }
    function CloseCon($conn){
        $conn -> close();
    }

?>