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
        $cekkata = mysqli_query($link,"SELECT * FROM tidakbaku");


        $counter = 0;
        while($row = mysqli_fetch_row($result)){
          $counter++;

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
          echo $panjang_array."\n";
          echo $counter.implode(" ", $unique_words)."\n";
          print_r($unique_words);
          echo "</pre>";

          for ($i=0; $i < $panjang_array; $i++) {
            $cocok 	= mysqli_query($link,"SELECT word FROM dictionary WHERE word = '$unique_words[$i]'");
            $tampung	= mysqli_num_rows($cocok);
            if ($tampung == 0) { //nyari kata yang tidak baku
              $cocokin = mysqli_query($link,"SELECT kata_alay FROM tidakbaku WHERE kata_alay = '$unique_words[$i]'");
              $tampungin = mysqli_num_rows($cocokin);
              // if ($tampungin == 0) { // nyari kata alay yg udah dimasukkin sblmnya
                echo "<pre>";
                echo "tidak baku\t:".$unique_words[$i];
                echo "</pre>";
                $query = "INSERT INTO tidakbaku (flag_id_komentar, kata_alay) VALUES ('$row[0]', '$unique_words[$i]')";

                if(mysqli_query($link, $query)){
                  echo "Records ADDED successfully.";
                }
                else
                {
                  echo "ERROR: Could not able to execute $query. " . mysqli_error($link);
                }
              // }
              // else {
                echo "<pre>";
                echo "tidak baku\t:".$unique_words[$i]."\n";
                echo "ID komentarnya:\t".$row[0]."\n";
                echo "</pre>";

                // echo $flag_id."\n";

                // $query = "UPDATE tidakbaku SET flag_id_komentar = '$flag_id' WHERE kata_alay = '$unique_words[$i]'";

                // if(mysqli_query($link, $query)){
                //   echo "Records ke update.";
                // }
                // else
                // {
                //   echo "ERROR: Could not able to execute $query. " . mysqli_error($link);
                // }
              // }
            }
            else {
            }
          }

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
