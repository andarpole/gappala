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
              $result = mysqli_query($link, "SELECT * FROM komentar");
              for ($i=1; $i < 15 ; $i++)
              {
                $row=mysqli_fetch_row($result);
            ?>
                <tr>
                  <td><?php echo "$row[0]"; ?></td>
                  <td><?php echo "$row[3]"; ?></td>
                  <td><?php echo "$row[4]"; ?></td>
                </tr>
            <?php
              }
            ?>
          </tbody>
        </table>
        <a href="preprop.php">next</a>
    <!-- Op tional JavaScript -->
  </body>
</html>
