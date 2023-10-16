<?php

require 'functions.php';

if (isset($_POST["submit"])) {
   if (data($_POST) > 0) {
      echo "
         <script>
            alert('Data berhasil ditambahkan!');
            document.location.href = 'index.php';
         </script>
      ";
   } else {
      echo "
      <script>
         alert('Data gagal ditambahkan!');
         document.location.href = 'index.php';
      </script>
   ";
   }
}
