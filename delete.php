<?php

include "inc/connection.php";

$delete=$db->exec("delete from siswa where id_siswa=".$_GET['id_siswa']);

if($delete)
{
    header("Location:index.php");
}

// var_dump($_GET['id_siswa']);