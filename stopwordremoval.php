<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>
    </title>
  </head>
  <body>
    <?php
        $link = mysqli_connect('localhost','root','root','sentipol2' );
        if($link)
        {
        }
        else
        {
              echo "koneksi database gagal.";
        }
    ?>

    <?php
        $result 	= mysqli_query($link,"SELECT * FROM preprocessing");
        $flag = 0;
        while($row = mysqli_fetch_row($result)){

          $words 	= [];
          $delim 	= " "."";
          $tok 	= strtok($row[1], $delim);

          while ($tok !== false) {
            $words[] = $tok;
            $tok = strtok($delim);
          }
          $unique_words = array_unique($words);
          $panjang_array = count($unique_words);

          echo "<pre>";
          echo "\nteksnya\t\t:".implode(" ", $unique_words)."\n";
          echo "panjang array\t:".$panjang_array."\n";
          print_r($unique_words);

          $simpan = [];
          $counter = 0;
          for ($i=0; $i < $panjang_array; $i++) {
            $cocok 	= mysqli_query($link,"SELECT word FROM dictionary WHERE word = '$unique_words[$i]' AND stopword = 'Ya'");
            $tampung	= mysqli_num_rows($cocok);
            if ($tampung > 0) {
              echo "stopword\t:".$unique_words[$i]."\n";
              $unique_words[$i] = '';
            }
            else {
              $simpan[$counter] = $unique_words[$i];
              $counter++;
            }
          }
          echo "\ntersimpan di baris ke-".$flag."\n";
          echo "teksnya jadi\t:".implode(" ",$simpan)."\n";
          print_r($simpan);
          echo "</pre>";
          $flag++;
          //bikin query buat nyimpan data kalo isi array tidak NULL
        }

     ?>

    <div class="container">
      <div class="header clearfix">
        <h3 class="text-muted">SentiPol</h3>
      </div>

        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Komentar</th>
              <th>Label</th>
            </tr>
          </thead>
          <tbody >
          </tbody>
        </table>

        <a href="preprop.php">next</a>
    </div>
    <!-- Op tional JavaScript -->
  </body>
</html>
