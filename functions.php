<?php

$conn = mysqli_connect("localhost", "root", "", "dbsmk");

function query($query)
{
   global $conn;
   $result = mysqli_query($conn, $query);
   $rows = [];
   while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
   }

   return $rows;
}

function data($data)
{
   global $conn;

   $nis = htmlspecialchars($data["nis"]);
   $nama = htmlspecialchars($data["nama"]);
   $alamat = htmlspecialchars($data["alamat"]);
   $jurusan = htmlspecialchars($data["jurusan"]);

   $jurusan_text = "";
   switch ($jurusan) {
      case "1":
         $jurusan_text = "AKL";
         break;
      case "2":
         $jurusan_text = "BDP";
         break;
      case "3":
         $jurusan_text = "TKJ";
         break;
      default:
         $jurusan_text = "";
         break;
   }

   $query = "INSERT INTO tb_mahasiswa
            VALUES
               ('', '$nis', '$nama', '$alamat', '$jurusan_text')
   ";

   mysqli_query($conn, $query);

   return mysqli_affected_rows($conn);
}

function deleteData($id)
{
   global $conn;

   mysqli_query($conn, "DELETE FROM tb_mahasiswa WHERE id = $id");

   return mysqli_affected_rows($conn);
}

function editData($data)
{
   global $conn;

   $id = $data["id"];
   $nis = htmlspecialchars($data["nis"]);
   $nama = htmlspecialchars($data["nama"]);
   $alamat = htmlspecialchars($data["alamat"]);
   $jurusan = htmlspecialchars($data["jurusan"]);

   $jurusan_text = "";
   switch ($jurusan) {
      case "1":
         $jurusan_text = "AKL";
         break;
      case "2":
         $jurusan_text = "BDP";
         break;
      case "3":
         $jurusan_text = "TKJ";
         break;
      default:
         $jurusan_text = $jurusan;
         break;
   }

   $query = "UPDATE tb_mahasiswa SET
               nis = '$nis',
               nama = '$nama',
               alamat = '$alamat',
               jurusan = '$jurusan_text'
            WHERE id = $id
   ";
   mysqli_query($conn, $query);

   return mysqli_affected_rows($conn);
}

function searchData($searching)
{
   global $conn;

   $query = "SELECT * FROM tb_mahasiswa WHERE
               nis LIKE '%$searching%' OR
               nama LIKE '%$searching%' OR
               alamat LIKE '%$searching%' OR
               jurusan LIKE '%$searching%'
   ";

   return query($query);
}

function register($data)
{
   global $conn;

   $username = strtolower(stripslashes($data["username"]));
   $password = mysqli_real_escape_string($conn, $data["password"]);
   $confirm = mysqli_real_escape_string($conn, $data["confirmpassword"]);

   $result = mysqli_query($conn, "SELECT username FROM tb_user WHERE username = '$username'");
   if (mysqli_fetch_assoc($result)) {
      echo "
         <script>
            alert('Username Sudah Ada');
         </script>";
      return false;
   }

   if ($password !== $confirm) {
      echo "
         <script>
            alert('Password Tidak Sesuai');
         </script>";
      return false;
   }

   $password = password_hash($password, PASSWORD_DEFAULT);

   mysqli_query($conn, "INSERT INTO tb_user VALUES('', '$username', '$password')");

   return mysqli_affected_rows($conn);
}
