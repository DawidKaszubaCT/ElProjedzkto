<?php
$conn = new mysqli("localhost", "root", "", "ekstraklasa");
$winrate = $conn->query("SELECT Winrate FROM kluby where IDK = 9");

$win = $conn->query("SELECT Wygrane FROM kluby WHERE IDK = 9");
$draw = $conn->query("SELECT Remisy FROM kluby WHERE IDK = 9");
$lose = $conn->query("SELECT Przegrane FROM kluby WHERE IDK = 9");

?>


<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <style>
        .container {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: conic-gradient(<?php echo $gradient; ?>);
        }
        #klubList li {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .color-box {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            border: 1px solid #000;
        }
        .Rakow:hover, .Jaga:hover, .Lech:hover, .Pogon:hover, .Legia:hover, .Gornik:hover, .Cracovia:hover, .Motor:hover, .GKS:hover, .Piast:hover, .Korona:hover, .Radom:hover, .Lodz:hover, .Puszcza:hover,.Stal:hover,.Lubin:hover, .Lechia:hover,.Slask:hover{
            color: transparent;
            background-size: 120%;
            background-repeat: no-repeat;
            background-position: center;
            padding:40px;
            border-radius:10px;
            transition: 1.5s ease-out;
            
        }
        .Rakow:hover{
            background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/a/af/Rks_rakow_crest_ai.svg/1200px-Rks_rakow_crest_ai.svg.png');
        }
        .Jaga:hover{
            background-image: url('https://upload.wikimedia.org/wikipedia/commons/e/e8/Jagiellonia_Bia%C5%82ystok_Logo_1.png');
        }
        .Lech:hover{
            background-image: url('https://upload.wikimedia.org/wikipedia/en/thumb/b/b0/KKS_Lech_Pozna%C5%84.svg/1200px-KKS_Lech_Pozna%C5%84.svg.png');
        }
        .Pogon:hover{
            background-image: url('https://sklep.pogonszczecin.pl/img/logo-1722321605.jpg');
        }
        .Legia:hover{
            background-image: url('https://upload.wikimedia.org/wikipedia/commons/a/a4/Legia_Warsaw_logo.png');
        }
        .Gornik:hover{
            background-image: url('https://upload.wikimedia.org/wikipedia/commons/d/d9/Gornik_Zabrze.png');
        }
        .Cracovia:hover{
            background-image:url('https://upload.wikimedia.org/wikipedia/en/thumb/b/b9/Cracovia_%28football_club%29_logo.svg/1200px-Cracovia_%28football_club%29_logo.svg.png');
        }
        .Motor:hover{
            background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/3/3d/Motor_Lublin_S.A._Oficjalny_Herb.png/800px-Motor_Lublin_S.A._Oficjalny_Herb.png');
        }
        .GKS:hover{
            background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/d/dc/GKS_KATOWICE_LOGO.png/640px-GKS_KATOWICE_LOGO.png');
        }
        .Piast:hover{
            background-image: url('https://upload.wikimedia.org/wikipedia/en/thumb/f/f6/GKS_Piast_Gliwice.svg/1200px-GKS_Piast_Gliwice.svg.png');
        }
        .Korona:hover{
            background-image: url('https://mks-korona-kielce.pl/wp-content/uploads/2018/11/korona_png.png');
        }
        .Radom:hover{
            background-image: url('https://upload.wikimedia.org/wikipedia/commons/2/2b/Herb_radomiaka_300dpi.png');
        }
        .Lodz:hover{
            background-image: url('https://upload.wikimedia.org/wikipedia/en/thumb/6/62/Widzew_Lodz.svg/1200px-Widzew_Lodz.svg.png');
        }
        .Puszcza:hover{
            background-image: url('https://upload.wikimedia.org/wikipedia/en/thumb/a/a1/Puszcza_Niepolomice_Herb_Full.svg/1200px-Puszcza_Niepolomice_Herb_Full.svg.png');
        }
        .Stal:hover{
            background-image: url('https://upload.wikimedia.org/wikipedia/en/thumb/f/f8/FKS-HerbGwiazda-1.svg/1200px-FKS-HerbGwiazda-1.svg.png');
        }
        .Lubin:hover{
            background-image: url('https://upload.wikimedia.org/wikipedia/en/thumb/2/20/Zag%C5%82%C4%99bie_Lubin_crest.svg/1200px-Zag%C5%82%C4%99bie_Lubin_crest.svg.png');
        }
        .Lechia:hover{
            background-image: url('https://upload.wikimedia.org/wikipedia/en/thumb/b/b7/Lechia_Gda%C5%84sk_logo.svg/1200px-Lechia_Gda%C5%84sk_logo.svg.png');
        }
        .Slask:hover{
            background-image: url('https://slask-www-cdn.stellis.one/documents/7763504/553355b5-0707-6e41-6c33-789adc35a095');
        }

        a{
            display: flex;
            align-items: center;
            align-content: center;
            transition: 1s ease-in;
            padding:10px;
        }
        .box_wdl, .box_poz,.box_wr{
            background: white;
            padding: 10px;
            text-align: center;
            border: 2px solid #081ca4;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.2s ease;
            min-height: 150px;
        }
        .box_wdl{
            display: flex;
            justify-content:center;
            align-items: center;
            flex-direction:column;
            background: #007435;
            color:white;
            border: 2px solid white;
            
        }
        .box_wdl p{
            height:15%;
            text-align:center;
            font-size:50px;
            margin:15px;
        }
        #numer{
            display: flex;
            align-items:center;
            justify-content:center;
            font-size: 120px;
            height:80%;
        }
        #rakow_logo{
            width:auto;
            height:300px;
        }
        .box{
            display:flex;
            justify-content:center;
            align-items:center;
        }
        .slice{
            position: absolute;
            width: 100%;
            height: 100%;
            background: conic-gradient(
                green 0% 39%,
                gray 39% 63%,
                red 63% 100%
            );
            clip-path: circle(50% at 50% 50%);
        }
        .dot{
            width: 80%;
            height: 80%;
            background-color: white;
            position: absolute;
            top: 10%;
            left: 10%;
            clip-path: circle(50% at 50% 50%);
            display: flex;
            justify-content: center;
            align-items:center;
            font-size:60px;
        }
        .container{
            position: relative;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: #ddd;
            overflow: hidden;
        }
        #wykres{
            height:80%;
            display:flex;
            justify-content:center;
            align-items: center;
        }
        #main-section{
            grid-template-columns: repeat(3, 1fr);
        }
        #minimg{
            width:auto;
            height:120px;
            margin-right:12px;
            margin-left:12px;
        }
        #box{
            font-size: 20px;
            display: flex;
            flex-direction: column;
        }
        #content{
            display:flex;
            justify-content:center;
            align-items: center;
        }
        .next_match{
            margin-bottom:70px;
        }
    </style>
</head>
<body>
    <main>
        <!-- Menu boczne -->
        <aside>
            <h2>Menu</h2>
            <a href="rakow.php" class="Rakow">Raków Częstochowa</a>
            <a href="jagiellonia.php" class="Jaga">Jagiellonia Białystok</a>
            <a href="lech.php" class="Lech">Lech Poznań</a>
            <a href="pogon.php" class="Pogon">Pogoń Szczecin</a>
            <a href="legia.php" class="Legia">Legia Warszawa</a>
            <a href="gornik.php" class="Gornik">Górnik Zabrze</a>
            <a href="cracovia.php" class="Cracovia">Cracovia</a>
            <a href="motor.php" class="Motor">Motor Lublin</a>
            <a href="gks.php"  class="GKS">GKS Katowice</a>
            <a href="piast.php" class="Piast">Piast Gliwice</a>
            <a href="korona.php" class="Korona">Korona Kielce</a>
            <a href="radom.php" class="Radom">Radomiak Radom</a>
            <a href="widzew.php" class="Lodz">Widzew Łódź</a>
            <a href="puszcza.php" class="Puszcza">Puszcza</a>
            <a href="stal.php" class="Stal">Stal Mielec</a>
            <a href="zaglebie.php" class="Lubin">Zagłębie Lubin</a>
            <a href="lechia.php" class="Lechia">Lechia Gdańsk</a>
            <a href="slask.php" class="Slask">Śląsk Wrocław</a>

            <a href="strona_glowna.php">Powrot</a>
        </aside>

        <!-- Główna sekcja -->
        <section id="main-section">
            <div class="box"><img src="https://upload.wikimedia.org/wikipedia/commons/d/dc/GKS_KATOWICE_LOGO.png" id="rakow_logo"></div>
            <div class="box_wdl">
                <p>
                    Wygrane: <?php
                         $row = $win->fetch_assoc();
                        printf("%s", $row["Wygrane"]);?>
                </p>
                <p>
                    Remisy: <?php
                         $row = $draw->fetch_assoc();
                        printf("%s", $row["Remisy"]);?>
                </p>
                <p>
                    Przegrane: <?php
                         $row = $lose->fetch_assoc();
                        printf("%s", $row["Przegrane"]);?>
                </p>
            </div>
            <div class="box_wr">
                <h1>Winrate</h1>
                <div id="wykres">
                    <div class="container">
                        <div class="slice"></div>
                        <div class="dot">
                            <?php
                                $row = $winrate->fetch_assoc();
                                printf("%s", $row["Winrate"]);
                            ?>%
                        </div>
                    </div>
                </div>
            </div>
            <div class="box_poz"> <h1>Pozycja</h1> 
            <div id="numer">9</div></div>
            <div class="box" id="box">
            <h1 class="next_match">Poprzedni mecz</h1>
            <div id="content">
                <img src="https://upload.wikimedia.org/wikipedia/commons/d/dc/GKS_KATOWICE_LOGO.png" id="minimg">
                GKS 0:1 Widzew
                <img src="https://upload.wikimedia.org/wikipedia/en/thumb/6/62/Widzew_Lodz.svg/1200px-Widzew_Lodz.svg.png" id="minimg">
            </div>
            </div>
            <div class="box" id="box">
                <h1 class="next_match">Nastepny mecz</h1>
                <div id="content">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/dc/GKS_KATOWICE_LOGO.png" id="minimg">
                    GKS - Górnik
                    
                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/d9/Gornik_Zabrze.png" id="minimg">
                </div>
                <p>30.03.25 17:30</p>   
            </div>
           
        </section>
    </main>

    <footer>
        <h2>Copyright by Super sigmas!</h2>
    </footer>
</body>
</html>
