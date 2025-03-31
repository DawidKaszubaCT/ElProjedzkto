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
$stracone = [];
$bilans = [];
$colors = []; // Kolory dla klubów
$colors2 = []; // Kolory dla klubów
$gradientSegments = []; // Segmenty gradientu
$gradientSegments2 = [];
$klubcolors = [];



if ($result->num_rows > 0) {
    $totalGole = 0; // Suma goli
    $totalStracone = 0; // Suma straconych

    while ($row = $result->fetch_assoc()) {
        $kluby[] = $row['Nazwa'];
        $gole[] = $row['Bramki_zdobyte'];
        $stracone[] = $row['Bramki_stracone'];
        $bilans[] = $row['Bilans'];
        $totalGole += $row['Bramki_zdobyte']; 
        $totalStracone += $row['Bramki_stracone'];
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
        $klubcolors[$kluby[$index]] = $color;

        $gradientSegments[] = "{$color} {$startAngle}deg, {$color} {$endAngle}deg";
        $startAngle = $endAngle; // Aktualizacja kąta startowego
    }

    $gradient = implode(", ", $gradientSegments); // Łączenie segmentów w gradient

    $startAngle2 = 0;
    $numClubs2 = count($kluby); // Liczba klubów
    foreach ($stracone as $index => $strata) {
        $percent2 = ($strata / $totalStracone) * 100; // Procent udziału goli
        $endAngle2 = $startAngle2 + ($percent2 * 3.6); // Obliczenie końcowego kąta

        // Generowanie unikalnego koloru HSL
        $hue2 = ($index * (360 / $numClubs)) % 360; // Zróżnicowanie kolorów
        $color2 = "hsl($hue2, 80%, 50%)";
        $colors2[] = $color2;
        $klubcolors[$kluby[$index]] = $color2;

        $gradientSegments2[] = "{$color2} {$startAngle2}deg, {$color2} {$endAngle2}deg";
        $startAngle2 = $endAngle2; // Aktualizacja kąta startowego
    }

    $gradient2 = implode(", ", $gradientSegments2); // Łączenie segmentów w gradient
}

// Pobieranie danych z tabel asystenci, zolte, czerwone
        $imieasystant = [];
        $ilosasystant= [];
        $klubasystant= [];
$asysty = $conn->query("SELECT Imie_nazwisko, Ilosc, klub FROM asystenci");
if ($asysty->num_rows > 0) {
    while ($row = $asysty->fetch_assoc()) {
        $imieasystant[] = $row['Imie_nazwisko'];
        $ilosasystant[] = $row['Ilosc'];
        $klubasystant[] = $row['klub'];
    }
}

        $imiezolte = [];
        $iloszolte = [];
        $klubzolte = [];
$zolte = $conn->query("SELECT Imie_nazwisko, Ilosc, klub FROM zolte");
if ($zolte->num_rows > 0) {
    while ($row = $zolte->fetch_assoc()) {
        $imiezolte[] = $row['Imie_nazwisko'];
        $iloszolte[] = $row['Ilosc'];
        $klubzolte[] = $row['klub'];
    }
}

        $imieczerwone = [];
        $ilosczerwone = [];
        $klubczerwone = [];
$czerwone = $conn->query("SELECT Imie_nazwisko, Ilosc, klub FROM czerwone");
if ($czerwone->num_rows > 0) {
    while ($row = $czerwone->fetch_assoc()) {
        $imieczerwone[] = $row['Imie_nazwisko'];
        $ilosczerwone[] = $row['Ilosc'];
        $klubczerwone[] = $row['klub'];
    }
}

$sql2 = "SELECT Imie_nazwisko, Ilosc, klub FROM strzelcy";
$result2 = $conn->query($sql2);

$imiona = [];
$ilosci = [];
$klub = [];

if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $imiona[] = $row['Imie_nazwisko'];
        $ilosci[] = $row['Ilosc'];
        $klub[] = $row['klub'];
    }
}

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
        .slice {
            width: 300px;
            height: 300px;
            position: relative;
            background: conic-gradient(<?php echo $gradient; ?>);
            clip-path: circle(50% at 50% 50%);
        }
        .slice2 {
            width: 300px;
            height: 300px;
            position: relative;
            background: conic-gradient(<?php echo $gradient2; ?>);
            clip-path: circle(50% at 50% 50%);
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
                    <?php foreach ($kluby as $index => $kluby2): ?>
                        <li>
                            <div class="color-box" style="background-color: <?php echo $colors[$index]; ?>;"></div>
                            <?php echo $kluby2; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Blok z wykresem -->
            <div class="box">
                <h3>Gole zdobyte (wykres)</h3>
        <div class="chart-container">
        <div class="bar-chart">
            <?php foreach ($ilosci as $index => $ilosc): ?>
                <div class="bar" style="height: <?php echo ($ilosc * 20); ?>px; background-color: <?php echo $klubcolors[$klub[$index]]; ?>;" title="<?php echo $imiona[$index] ?>">
                    <?php echo $imiona[$index] . " " . $ilosc; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

            </div>

            <div class="box"><h3>Asysty (wykres)</h3> 
            <div class="chart-container">
        <div class="bar-chart">
            <?php foreach ($ilosasystant as $index => $iloscasystant): ?>
                <div class="bar" style="height: <?php echo ($iloscasystant * 40); ?>px; background-color: <?php echo $klubcolors[$klubasystant[$index]]; ?>;" title="<?php echo $imieasystant[$index] ?>">
                    <?php echo $imieasystant[$index] . " " . $iloscasystant; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
            <div class="box"><h3>Żółta kartka (wykres)</h3>
            <div class="chart-container">
        <div class="bar-chart">
            <?php foreach ($iloszolte as $index => $ilosczolte): ?>
                <div class="bar" style="height: <?php echo ($ilosczolte * 35); ?>px; background-color: <?php echo $klubcolors[$klubzolte[$index]]; ?>;" title="<?php echo $imiezolte[$index] ?>">
                    <?php echo $imiezolte[$index] . " " . $ilosczolte; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>



            <div class="box"><h3>Czerwona kartka (wykres)</h3>

            <div class="chart-container">
        <div class="bar-chart">
            
            <?php foreach ($ilosczerwone as $index => $iloscczerwone): ?>
                <div class="bar" style="height: <?php echo ($iloscczerwone * 150); ?>px; background-color: <?php echo $klubcolors[$klubczerwone[$index]]; ?>;" title="<?php echo $imieczerwone[$index] ?>">
                    <?php echo $imieczerwone[$index] . " " . $iloscczerwone; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
            </div>

            <div class="box"><h3>Gole zdobyte (wykres z klubowych)</h3>
                <div class="slice">
                    <div class="dot"><?php echo $totalGole ?></div>
                </div>    
            </div>

            <div class="box"><h3>Gole stracone (wykres z klubowych)</h3>
                <div class="slice2">
                    <div class="dot"><?php echo $totalStracone ?></div>
                </div>
        </div>
            <div class="box"><h3>Bilans</h3> 
            <div class="chart-container">
    <div class="bar-chart">
    <?php 
array_multisort($bilans, SORT_DESC, $kluby, $colors); 
foreach ($bilans as $index => $bilan): ?>

            <div class="bar" style="height: <?php echo ($bilan * 15); ?>px; background-color: <?php echo $colors[$index]; ?>;" title="<?php echo $kluby[$index] ?>">
                <?php echo $kluby[$index] . " " . $bilan; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
        
        </div>
        </section>
    </main>

    <footer>
        <h2>Copyright by Super sigmas!</h2>
    </footer>
</body>
</html>
