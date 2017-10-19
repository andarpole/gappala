<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>
    </title>
  </head>
  <body>
<!-- connect database     -->
    <?php
        $link = mysqli_connect('localhost','root','','sentipol2' );
        if($link)
        {
        }
        else
        {
              echo "koneksi database gagal.";
        }
    ?>

<!-- Tokenisasi -->
    <?php
        $result = mysqli_query($link, "SELECT * FROM preprocessing");

        while($row = mysqli_fetch_row($result))
        {

      			$words 	= [];
      			$delim 	= " \n.,;-()?></!:@";
            $tok 	= strtok($row[1], $delim);

            while ($tok !== false) {
      			  $words[] = $tok;
      			  $tok = strtok($delim);
            }

            $unique_words = array_unique($words);

  			    print "<pre>";
            print $row[1]."\n";
            print_r($unique_words);
  			    print "</pre>";
        }
    ?>
  <a href="preprop.php">next</a>
    <!-- Op tional JavaScript -->
  </body>
</html>
