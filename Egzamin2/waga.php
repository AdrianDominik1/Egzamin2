<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styl4.css">
    <title>Twój wskaźnik BMI</title>
</head>
<body>
    <div class="baner">
        <h2>Oblicz wskaźnik BMI</h2>
    </div>
    <div class="logo">
        <img src="wzor.png" alt="liczymy BMI">
    </div>
    <div class="lewy">
        <img src="rys1.png" alt="zrzuć kalorie">
    </div>
    <div class="prawy">
        <h1>Podaj dane</h1><br>
        <form action="" method="post">
            Waga: <input type="number" id="Waga" name="Waga"><br>
            Wzrost: <input type="number" id="wzrost" name="wzrost"><br>
            <input type="submit" value="Licz BMI i zapisz wynik">
        </form>
        <?php
            require("connect.php");
            if(!empty($_POST['Waga']) && !empty($_POST['wzrost']))
            {
                $Waga= $_POST['Waga'];
                $wzrost= $_POST['wzrost'];
                $data = date('Y-m-d');
                $bmi=$Waga/($wzrost*$wzrost)*10000;
                echo "twoja waga: ".$Waga."; Twój wzrost: ".$wzrost."<br> BMI wynosi: ". $bmi;
                if($bmi <=18.99)
                {
                    $i = 1;
                }
                else if($bmi <=25.99 && $bmi >= 19)
                {
                    $i = 2;
                }
                else if($bmi <=30.99 && $bmi >= 26)
                {
                    $i = 3;
                }
                else if($bmi >= 31)
                {
                    $i = 4;
                }  
                $qr="INSERT INTO wynik(bmi_id, data_pomiaru, wynik) VALUES ('$i','$data','$bmi')";
                $conn->query($qr);
            }
            mysqli_close($conn);
        ?>
    </div>
    <div class="glowny">
        <table>
            <tr>
                <th>Lp.</th>
                <th>Interpretacja</th>
                <th>Zaczyna się od...</th>
            </tr>
            <?php
                require("connect.php");
                $qr="SELECT id, informacja, wart_min FROM bmi"; 
                $result = $conn->query($qr);
                while($r = $result->fetch_array())
                {
                    echo "<tr><td>".$r[0]."</td><td>".$r[1]."</td><td>".$r[2]."</td></tr>";
                }
            ?>
        </table>
    </div>
    <div class="stopka">
        Autorzy: Mati Adi Alan
        <a href="kw2.jpg">Wynik działania kwerendy 2</a>
    </div>
</body>
</html>