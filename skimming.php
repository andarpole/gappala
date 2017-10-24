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

    <form action="/skimming.php" method="post">
        Masukkan kata:<br>
        <input type="text" name="kata"><br>
        <input type="submit" value="Submit">
    </form>

    
</html>