<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário 2024</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        td.bold {
            font-weight: bold;
        }
        td.red {
            color: red;
        }
        table {
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: center;
            align-items: center/
            border: 1px solid #000;
        }
        .month {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <main>
        <?php
            function linha($semana, $dia_atual) {
                echo "<tr>";
                for ($i = 0; $i <= 6; $i++) {
                    if (isset($semana[$i])) {
                        $classes = '';

                        if ($i == 0) {
                            $classes .= 'red ';
                        }

                        if ($i == 6 || $semana[$i] == $dia_atual) {
                            $classes .= 'bold ';
                        }

                        $classes = trim($classes);

                        if ($classes != '') {
                            echo "<td class='{$classes}'>{$semana[$i]}</td>";
                        } else {
                            echo "<td>{$semana[$i]}</td>";
                        }
                    } else {
                        echo "<td></td>";
                    }
                }
                echo "</tr>";
            }

            function calendario($mes, $ano) {
                $dia = 1;
                $semana = array();

                $dia_atual = date('Y') == $ano && date('n') == $mes ? date('j') : 0;

                $dia_semana = date('w', mktime(0, 0, 0, $mes, 1, $ano));

                for ($i = 0; $i < $dia_semana; $i++) {
                    array_push($semana, "");
                }

                while ($dia <= date('t', mktime(0, 0, 0, $mes, 1, $ano))) {
                    array_push($semana, $dia);

                    if (count($semana) == 7) {
                        linha($semana, $dia_atual);
                        $semana = array();
                    }
                    $dia++;
                }

                if (!empty($semana)) {
                    linha($semana, $dia_atual);
                }
            }

            function calendario_anual($ano) {
                $meses = array(
                    1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
                    5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
                    9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
                );

                for ($mes = 1; $mes <= 12; $mes++) {
                    echo "<div class='month'>";
                    echo "<h2>{$meses[$mes]} $ano</h2>";
                    echo "<table border='1'>
                            <tr>
                                <th>Dom</th>
                                <th>Seg</th>
                                <th>Ter</th>
                                <th>Qua</th>
                                <th>Qui</th>
                                <th>Sex</th>
                                <th>Sab</th>
                            </tr>";
                    calendario($mes, $ano);
                    echo "</table>";
                    echo "</div>";
                }
            }

            calendario_anual(2024);
        ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
