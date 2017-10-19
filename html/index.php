<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>coba coba to</title>
  </head>
  <body>
      <?php
          $link = mysqli_connect('localhost','root','','sentipol' );
          if($link)
          {
                echo "koneksi database berhasil. </br> </br>";
          }
          else
          {
                echo "koneksi database gagal.";
          }

           $result = mysqli_query($link, "SELECT * FROM data_sentipol");

           while ($row=mysqli_fetch_row($result))
           {
              echo "$row[10]";
              echo "<br /><br />";
            }
      ?>
  </body>
</html>
