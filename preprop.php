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
        $result = mysqli_query($link, "SELECT * FROM komentar");
        $insPrep = "INSERT INTO preprocessing (id_komentar, komen_casefold) VALUES";
        $query_parts = array();

        //casefolding
        for ($i = 1; $i < 25 ; $i++) {
          $row=mysqli_fetch_row($result);
          $query_parts[] = "('" . $row[0]."', '" . strtolower($row[3]). "')";

        }
        $insPrep .= implode(', ', $query_parts);

        if(mysqli_query($link, $insPrep)){
          echo "Records added successfully.";
        }
        else
        {
          echo "ERROR: Could not able to execute $insPrep. " . mysqli_error($link);
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

        <a href="cleanse.php">next</a>
    </div>
    <!-- Op tional JavaScript -->
  </body>
</html>
