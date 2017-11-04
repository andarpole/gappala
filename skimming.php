<html>
    <?php
        if(!empty($_POST['kata'])){
            $kata = $_POST['kata'];
            $link = "http://kateglo.com/api.php?format=json&phrase=".$kata;
            $data = json_decode(file_get_contents($link), true);
            echo "kata dasarnya adalah ".$data['kateglo']['root'][0]['root_phrase'];
            // print_r($data); 
        }
    ?>

    <p>Halooo semuanya </p>

    <form action="/skimming.php" method="post">
        Masukkan kata:<br>
        <input type="text" name="kata"><br>
        <input type="submit" value="Submit">
    </form>

    <table>
        <?php
            
            $link = mysqli_connect('localhost','root','root','sentipol2' );
            if($link){}else{echo "koneksi database gagal.";} 

            function cekkata(&$katanya){
                $link = "http://kateglo.com/api.php?format=json&phrase=".$katanya;
                $data = json_decode(file_get_contents($link), true);
                $katanya = $data['kateglo']['root'][0]['root_phrase'];
            }

            $result = mysqli_query($link, "SELECT * FROM tokenization");
            
            while($row = mysqli_fetch_row($result)){

                $cek = $row[2];

                if(substr($cek, 0, 2) == 'me'){
                    cekkata($cek);
                }
                else if(substr($cek, 0, 3) == 'ber'){
                    cekkata($cek);
                }

                if($cek == $row[2]){
                    $cek = '';
                }

                ?>
                    <tr>
                        <td><?php echo "$row[2]"; ?></td>
                        <td><?php echo $cek; ?></td>
                    </tr>
                <?php
            }
        ?>
    </table>
</html>