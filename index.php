<?php

require 'functions.php';
$mahasiswa = query("SELECT * FROM tb_mahasiswa");

if (isset($_POST["find"])) {
   $mahasiswa = searchData($_POST["searching"]);
}

?>

<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Halaman Admin</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

   <div class="container d-flex align-items-center flex-column">
      <div class="row mt-4 user-select-none">
         <div class="col">
            <div class="card" style="width: 48rem;">
               <div class="card-header fw-bold">
                  Create / Edit Data
               </div>
               <div class="card-body">
                  <form action="data.php" method="post">
                     <div class="mb-3 row">
                        <label for="inputNIS" class="col-sm-2 col-form-label">NIS</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control" id="inputNIS" name="nis" placeholder="Masukkan NIS Anda">
                        </div>
                     </div>
                     <div class="mb-3 row">
                        <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control" id="inputNama" name="nama" placeholder="Masukkan Nama Anda">
                        </div>
                     </div>
                     <div class="mb-3 row">
                        <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control" id="inputAlamat" name="alamat" placeholder="Masukkan Alamat Anda">
                        </div>
                     </div>
                     <div class="mb-3 row">
                        <label for="inputJurusan" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-10">
                           <select class="form-select" aria-label="Default select example" id="inputJurusan" name="jurusan" required>
                              <option disabled selected hidden>- Pilih Jurusan -</option>
                              <option value="1">AKL</option>
                              <option value="2">BDP</option>
                              <option value="3">TKJ</option>
                           </select>
                        </div>
                     </div>
                     <div class="row">
                        <label for="" class="col-sm-2"></label>
                        <div class="col-sm-3">
                           <button type="submit" class="btn btn-primary" name="submit">Simpan Data</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>

      <div class="row mt-3 user-select-none">
         <div class="col">
            <div class="card" style="width: 48rem;">
               <div class="card-header fw-bold">
                  Pencarian Data Mahasiswa
               </div>
               <div class="card-body">
                  <form action="" method="post">
                     <div class="row">
                        <div class="col-sm-10">
                           <input type="text" class="form-control" name="searching" autofocus placeholder="Telusuri Data Mahasiswa" autocomplete="off">
                        </div>
                        <div class="col-sm-2">
                           <button type="submit" class="btn btn-primary" name="find">Cari Data</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>

      <div class="row mt-3">
         <div class="col">
            <div class="card" style="width: 48rem;">
               <div class="card-header bg-secondary text-white fw-medium user-select-none">
                  Data Mahasiswa
               </div>
               <div class="card-body">
                  <table class="table">
                     <thead>
                        <tr>
                           <th scope="col">#</th>
                           <th scope="col">NIS</th>
                           <th scope="col">Nama</th>
                           <th scope="col">Alamat</th>
                           <th scope="col">Jurusan</th>
                           <th scope="col">Aksi</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach ($mahasiswa as $no => $mhs) : ?>
                           <tr>
                              <th> <?= $no + 1 ?> </th>
                              <td> <?= $mhs["nis"]; ?> </td>
                              <td> <?= $mhs["nama"]; ?> </td>
                              <td> <?= $mhs["alamat"]; ?> </td>
                              <td> <?= $mhs["jurusan"]; ?> </td>
                              <td>
                                 <a href="edit.php?id=<?= $mhs["id"]; ?>">Edit</a>
                                 <a href="delete.php?id=<?= $mhs["id"]; ?>" class="ms-2" onclick="return confirm('Anda yakin?');">Delete</a>
                              </td>
                           </tr>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
                  <?php if (count($mahasiswa) == 0) : ?>
                     <h3 class="text-danger"> <?= "Data Tidak Ditemukan"; ?> </h3>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </div>
   </div>

   <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>