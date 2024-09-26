<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Periksa Bilangan Prima dengan PHP</title>
    <style>
        /* Mengatur gaya dasar untuk body */
        body {
            font-family: Arial, sans-serif;
            background-image: url('bc.jpg'); 
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat; 
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Kontainer utama untuk form */
        .container {
            background-color: rgba(255, 255, 255, 0.4);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            color: black;
        }

        /* Gaya untuk label dan input */
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: black;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Gaya untuk pesan hasil */
        p {
            font-size: 16px;
            color: black;
        }

        /* Kontainer hasil dengan scroll ke bawah */
        .result {
            background-color: #f0f8f;
            padding: 10px;
            border: 1px solid #007bff;
            border-radius: 5px;
            margin-top: 10px;
            max-height: 150px; /* Batas tinggi */
            overflow-y: auto;  /* Aktifkan scroll vertikal */
            white-space: normal; /* Bilangan tampil secara vertikal */
            text-align: left; /* Bilangan ditampilkan rata kiri */
            line-height: 1.5; /* Spasi antar bilangan */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Periksa Bilangan Prima menggunakan Algoritma Serial</h2>
        <!-- Form input untuk menerima rentang bilangan dari pengguna -->
        <form method="POST" action="">
            <label for="start">Masukkan Bilangan Pertama:</label>
            <input type="number" id="start" name="start" required>
            <br>
            <label for="end">Masukkan Bilangan Terakhir:</label>
            <input type="number" id="end" name="end" required>
            <br>
            <input type="submit" value="Periksa">
        </form>

        <?php
        // Fungsi untuk memeriksa apakah sebuah bilangan prima
        function isPrime($num) {
            // Jika bilangan kurang dari 2, bukan prima
            if ($num < 2) {
                return false;
            }

            // Periksa pembagi dari 2 sampai sqrt(num)
            for ($i = 2; $i <= sqrt($num); $i++) {
                if ($num % $i == 0) {
                    return false; // Bukan prima jika ada pembagi selain 1 dan num
                }
            }
            return true; // Jika tidak ada pembagi, maka prima
        }

        // Algoritma Serial untuk mencari bilangan prima dalam rentang
        function findPrimesInRange($start, $end) {
            $primeNumbers = [];
            for ($num = $start; $num <= $end; $num++) {
                if (isPrime($num)) {
                    $primeNumbers[] = $num;
                }
            }
            return $primeNumbers;
        }

        // Memproses hasil jika ada input dari pengguna
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $start = $_POST['start'];
            $end = $_POST['end'];

            // Mencatat waktu awal
            $startTime = microtime(true);
            $startTimeFormatted = gmdate("H:i:s", (int)$startTime);

            echo "<p>Waktu awal proses: $startTimeFormatted</p>";
            echo "<div class='result'><p>Bilangan prima antara $start dan $end adalah:</p>";

            // Memanggil algoritma serial untuk menemukan bilangan prima
            $primeNumbers = findPrimesInRange($start, $end);

            // Menampilkan hasil bilangan prima
            if (count($primeNumbers) > 0) {
                foreach ($primeNumbers as $prime) {
                    echo "$prime<br>"; // Menampilkan secara vertikal
                }
            } else {
                echo "<p>Tidak ada bilangan prima dalam rentang tersebut.</p>";
            }

            echo "</div>";

            // Mencatat waktu akhir
            $endTime = microtime(true);
            $endTimeFormatted = gmdate("H:i:s", (int)$endTime);
            echo "<p>Waktu akhir proses: $endTimeFormatted</p>";

            // Menghitung selisih waktu
            $executionTime = $endTime - $startTime;
            echo "<p>Total waktu proses: " . number_format($executionTime, 6) . " detik.</p>";
        }
        ?>
    </div>
</body>
</html>
