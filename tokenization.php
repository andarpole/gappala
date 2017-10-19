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
        $link = mysqli_connect('localhost','root','root','sentipol2' );
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
        // $row = mysqli_fetch_row($result)
        // print_r($row);

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
            $flag = count($unique_words); //menghitung panjang array

            foreach($unique_words as $value){
              echo $value."<br>";

              $sql = "INSERT INTO tokenization (id_komentar, token) VALUES ( '$row[0]', '$value');";

              if(mysqli_query($link, $sql)){
                echo "Records added successfully.";
              }
              else
              {
                echo "ERROR: Could not able to execute " . mysqli_error($link);
              }
            }
            for($i = 0; $i < $flag; $i++){
              if($i>0){
                $x = $i-1;
                $bigram = $unique_words[$x]." ".$unique_words[$i];

                $sql = "INSERT INTO tokenization (id_komentar, token) VALUES ( '$row[0]', '$bigram');";
                
                if(mysqli_query($link, $sql)){
                  echo "Records added successfully.";
                }
                else
                {
                  echo "ERROR: Could not able to execute " . mysqli_error($link);
                }
              }
            }
        }
    ?>
  <a href="preprop.php">next</a>
    <!-- Op tional JavaScript -->
  </body>
</html>
