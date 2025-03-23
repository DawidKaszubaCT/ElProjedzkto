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
    </style>
</head>
<body>
<script>
        document.addEventListener("DOMContentLoaded", function() {
            const links = document.querySelectorAll("aside a");
            const boxes = document.querySelectorAll(".box");
            
            links.forEach((link, index) => {
                link.addEventListener("click", () => {
                    boxes.forEach(box => box.classList.remove("active"));
                    if (boxes[index]) {
                        boxes[index].classList.add("active");
                        
                        setTimeout(() => {
                            boxes[index].classList.remove("active");
                        }, 3000); 
                    }
                });
            });
        });
    </script>
    <main>
        <!-- Menu boczne -->
        <aside>
            <h2>Menu</h2>
            <a href="#">Tabela</a>
            <a href="#">Gole</a>
            <a href="#">Asysty</a>
            <a href="#">Żółta kartka</a>
            <a href="#">Czerwona kartka</a>
            <a href="#">Gole zdobyte</a>
            <a href="#">Gole stracone</a>
            <a href="#">Bilans</a>
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

            <div class="box">Asysty (wykres)</div>
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
