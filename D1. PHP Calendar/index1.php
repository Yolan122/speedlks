<!DOCTYPE html>
<html>
<head>
    <title>Kalender</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .calendar {
            width: 500px;
            margin: 50px auto;
            background: linear-gradient(to bottom, #e0e0e0, #f2f2f2);
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }
        table {
            width: 100%;
        }
        th, td {
            text-align: center;
            padding: 10px;
        }
        th {
            background-color: #333;
            color: white;
        }
        .today {
            background-color: red;
            color: white;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <div class="calendar">
        <?php
        date_default_timezone_set('Asia/Jakarta');
        $hari_ini = date('d');
        $hari_ini_formatted = date('Y-m-d');
        $bulan_ini = date('F');
        $tahun_ini = date('Y');
        
        echo "<h1>Kalender Bulan Ini</h1>";
        echo "<p>$bulan_ini $tahun_ini</p>";
        
        $nama_hari = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");
        echo "<table>";
        echo "<tr>";
        foreach ($nama_hari as $hari) {
            echo "<th>$hari</th>";
        }
        echo "</tr>";
        
        // Menghitung jumlah hari dalam bulan ini
        $jumlah_hari = date('t');
        
        // Menentukan hari pertama dalam bulan ini
        $tanggal_pertama = strtotime(date('Y-m-01'));
        $nama_hari_pertama = date('N', $tanggal_pertama);
        
        echo "<tr>";
        $day_count = 1;
        for ($i = 1; $i <= 7; $i++) {
            if ($i < $nama_hari_pertama) {
                echo "<td></td>";
            } else {
                if ($day_count == $hari_ini) {
                    echo "<td class='today'>$day_count</td>";
                } else {
                    echo "<td>$day_count</td>";
                }
                $day_count++;
            }
        }
        echo "</tr>";
        
        for ($week = 2; $week <= 6; $week++) {
            echo "<tr>";
            for ($day = 1; $day <= 7; $day++) {
                if ($day_count > $jumlah_hari) {
                    echo "<td></td>";
                } else {
                    if ($day_count == $hari_ini) {
                        echo "<td class='today'>$day_count</td>";
                    } else {
                        echo "<td>$day_count</td>";
                    }
                    $day_count++;
                }
            }
            echo "</tr>";
        }
        
        echo "</table>";
        ?>
    </div>
</body>
</html>
