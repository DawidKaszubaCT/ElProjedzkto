<?php
$conn = new mysqli("localhost", "root", "", "ekstraklasa");

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

// Pobieranie danych z tabeli kluby
$sql = "SELECT * FROM kluby";
$result = $conn->query($sql);

$kluby = [];
$gole = [];
$colors = []; // Kolory dla klubów
$gradientSegments = []; // Segmenty gradientu


if ($result->num_rows > 0) {
    $totalGole = 0; // Suma goli

    while ($row = $result->fetch_assoc()) {
        $kluby[] = $row['Nazwa'];
        $gole[] = $row['Bramki_zdobyte'];
        $totalGole += $row['Bramki_zdobyte']; 
    }

    // Generowanie kolorów i gradientów
    $startAngle = 0;
    $numClubs = count($kluby); // Liczba klubów
    foreach ($gole as $index => $gol) {
        $percent = ($gol / $totalGole) * 100; // Procent udziału goli
        $endAngle = $startAngle + ($percent * 3.6); // Obliczenie końcowego kąta

        // Generowanie unikalnego koloru HSL
        $hue = ($index * (360 / $numClubs)) % 360; // Zróżnicowanie kolorów
        $color = "hsl($hue, 80%, 50%)";
        $colors[] = $color;

        $gradientSegments[] = "{$color} {$startAngle}deg, {$color} {$endAngle}deg";
        $startAngle = $endAngle; // Aktualizacja kąta startowego
    }

    $gradient = implode(", ", $gradientSegments); // Łączenie segmentów w gradient
}

// Pobieranie danych z tabel asystenci, zolte, czerwone
$asysty = $conn->query("SELECT Imie_nazwisko, Ilosc, klub FROM asystenci");
$zolte = $conn->query("SELECT Imie_nazwisko, Ilosc, klub FROM zolte");
$czerwone = $conn->query("SELECT Imie_nazwisko, Ilosc, klub FROM czerwone");

// Struktura danych dla sekcji
$sections = [
    "Asysty" => $asysty,
    "Żółta kartka" => $zolte,
    "Czerwona kartka" => $czerwone,
    "Gole zdobyte" => $result,
    "Gole stracone" => $result,
    "Bilans" => $result
];

$conn->close();
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
    </style>
</head>
<body>
    <main>
        <!-- Menu boczne -->
        <aside>
            <h2>Menu</h2>
            <a href="#" class="Rakow">Raków Częstochowa</a>
            <a href="#" class="Jaga">Jagiellonia Białystok</a>
            <a href="#" class="Lech">Lech Poznań</a>
            <a href="#" class="Pogon">Pogoń Szczecin</a>
            <a href="#" class="Legia">Legia Warszawa</a>
            <a href="#" class="Gornik">Górnik Zabrze</a>
            <a href="#" class="Cracovia">Cracovia</a>
            <a href="#" class="Motor">Motor Lublin</a>
            <a href=""  class="GKS">GKS Katowice</a>
            <a href="" class="Piast">Piast Gliwice</a>
            <a href="" class="Korona">Korona Kielce</a>
            <a href="" class="Radom">Radomiak Radom</a>
            <a href="" class="Lodz">Widzew Łódź</a>
            <a href="" class="Puszcza">Puszcza</a>
            <a href="" class="Stal">Stal Mielec</a>
            <a href="" class="Lubin">Zagłębie Lubin</a>
            <a href="" class="Lechia">Lechia Gdańsk</a>
            <a href="" class="Slask">Śląsk Wrocław</a>
        </aside>

        <!-- Główna sekcja -->
        <section id="main-section">
            <!-- Tabela klubów -->
            <div class="box">
                <h3>Tabela klubów</h3>
                <ul id="klubList">
                    <?php foreach ($kluby as $index => $klub): ?>
                        <li>
                            <div class="color-box" style="background-color: <?php echo $colors[$index]; ?>;"></div>
                            <?php echo $klub; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Blok z wykresem -->
            <div class="box">
                <h3>Gole zdobyte (wykres)</h3>
                <div class="pie-chart">
                <div class="container" style="background: conic-gradient(<?php echo $gradient; ?>); width: 300px; height: 300px; border-radius: 50%; display: block;"></div>

                </div>
            </div>

            <div class="box" id="wrapper">Asysty (wykres)</div>
            <div class="box">Żółta kartka (wykres)</div>
            <div class="box">Czerwona kartka (wykres)</div>
            <div class="box">Gole zdobyte (wykres z klubowych)</div>
            <div class="box">Gole stracone (wykres z klubowych)</div>
            <div class="box">Bilans (wykres => bramki zdobyte - bramki stracone)</div>
        </section>
    </main>

    <footer>
        <h2>Copyright by Super sigmas!</h2>
    </footer>
</body>
</html>
