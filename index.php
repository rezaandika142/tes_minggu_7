<?php

include 'inc/connection.php';


$siswa=$db->query("select * from siswa");
$data_siswa=$siswa->fetchAll();
// echo $data_siswa;

foreach ($data_siswa as $key) {
    // echo $key['nama']."  ".$key['pekerjaan']."<br>";
}

if(isset($_POST['search']))
{


    $filter=$db->quote($_POST['search']);
    

    $name=$_POST['search'];

    $search=$db->prepare("select * from siswa where nama_siswa=? or sekolah=? or motivasi=?");

    $search->bindValue(1,$name,PDO::PARAM_STR);
    $search->bindValue(2,$name,pdo::PARAM_STR);
    $search->bindValue(3,$name,pdo::PARAM_STR);

    $search->execute();

    $tampil_data=$search->fetchAll(); 

    $row = $search->rowCount();
    

}else{
    $data = $db->query("select * from siswa");

    $tampil_data = $data->fetchAll();
}
$temp_arr=[];
foreach ($data_siswa as $value) {
    $temp_arr[]=$value['sekolah'];
}
$temp_new=array_unique($temp_arr);

$showFilter=[];
if (isset($_POST['filter'])) {
  $filter=$_POST['filter'];
  if ($filter=="") {
    $showFilter=$data_siswa;
  }else {
    foreach ($data_siswa as $key) {
      if ($key[2]==$filter) {
        $showFilter[]=[$key['id_siswa'],$key['nama_siswa'],$key['sekolah'],$key['motivasi']];
      }
    }
  }
}else {
  $showFilter=$data_siswa;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Minggu ke-7</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>
<body>
<div class="container">
        <div class="row">
            <div class="col">

            <!-- Allert Massage -->
            <?php if(isset($row)):?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <p class="lead "><?php echo $row;?> Data Ditemukan !</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif; ?>
            <form class="form-inline" action="index.php" method="POST">
                <div class="form-group mx-sm-3 mb-2 mt-3">
                    <input type="text" class="form-control" name="search" placeholder="Nama atau Sekolah">
                    <button class="btn-primary" type="submit"><i class="fas fa-search" ></i></button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <table class="table table-striped">
  <thead class="thead-like">
    <tr>
      <th scope="col">ID Siswa</th>
      <th scope="col">Nama</th>
      <th scope="col">Sekolah</th>
      <th scope="col">Motivasi</th>
      <th scope="col">Menu</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach ($data_siswa as $key): ?>
    <tr>
      <td><?php echo $key['id_siswa'];?></td>
      <td><?php echo $key['nama_siswa'];?></td>
      <td><?php echo $key['sekolah'];?></td>
      <td><?php echo $key['motivasi'];?></td>
      <td> <a class="btn btn-danger" data-toggle="modal" data-target="#nama_siswa">Delete</a>  <a class="btn btn-primary" href="edit.php?id_siswa=<?php echo $key['id_siswa']; ?>">Edit</a></td>
    </tr>
      <?php endforeach; ?>
  </tbody>
</table>

<div class="modal" id="nama_siswa" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus data ini?.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a type="button" class="btn btn-primary"href="delete.php?id_siswa=<?php echo $key['id_siswa']; ?>">Hapus Data</a>
      </div>
    </div>
  </div>
</div>

<!-- Form Input Siswa -->

<div class="container">
    <div class="row">
        <div class="col-12">
          <h3 style="text-align: center;">Tambah Data</h3>
            <form action="input.php" method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Siswa</label>
                    <input type="text" name="nama_siswa" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Sekolah</label>
                    <input type="text" name="sekolah" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Motivasi</label>
                    <input type="text" name="motivasi" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
    <form>
</div>
<select name="filter" id="" class="w-75">
        <option value="">All</option>
      <?php foreach ($temp_new as $key) : ?>
        <option value="<?php echo $key; ?>"><?php echo $key; ?></option>
      <?php endforeach; ?>
      </select>
      <input type="submit" value="filter">
      </form>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>