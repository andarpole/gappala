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
        $result = mysqli_query($link, "SELECT * FROM preprocessing");

        //cleaning non alphabetical
        while($row = mysqli_fetch_row($result))
        {
            $words 	= [];
            $delim 	= " \r\t\n.,;-()?></!%:@1234567890#&"."";
            $tok 	= strtok($row[1], $delim);

            while ($tok !== false) {
              $words[] = $tok;
              $tok = strtok($delim);
            }
            $unique_words = array_unique($words);
            $panjang_array = count($unique_words);
            $bersih = implode(" ", $unique_words);
            $query = "UPDATE preprocessing SET komen_casefold = '$bersih' WHERE id_komentar = '$row[0]'";
            if(mysqli_query($link, $query)){
              echo "Records updated successfully.";
            }
            else
            {
              echo "ERROR: Could not able to execute $query. " . mysqli_error($link);
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
            <?php
              $result = mysqli_query($link, "SELECT * FROM preprocessing");
              for ($i=1; $i <= 25 ; $i++)
              {
                $row=mysqli_fetch_row($result);
            ?>
                <tr>
                  <td><?php echo "$row[0]"; ?></td>
                  <td><?php echo "$row[1]"; ?></td>
                </tr>
            <?php
              }
            ?>
          </tbody>
        </table>

        <a href="preprop.php">next</a>
    </div>
    <!-- Op tional JavaScript -->
  </body>
</html>
