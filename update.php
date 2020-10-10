<?php

include "inc/connection.php";



$input=$db->exec("update siswa set nama_siswa='".$_POST['nama_siswa']."',sekolah='".$_POST['sekolah']."',motivasi='".$_POST['motivasi']."'where id_siswa=".$_POST['id_siswa']);

if($input)
{
    header("Location:index.php");
}
// $update=$db->exec("update siswa set nama='".$_POST['nama']."',pekerjaan='".$_POST['pekerjaan']."'where id_siswa=".$_POST['id_siswa']);