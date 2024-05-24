# Calendário 2024

Este projeto é uma aplicação PHP que gera um calendário completo para o ano de 2024. O calendário exibe os domingos em vermelho, os sábados em negrito e destaca o dia atual em negrito.

## Funcionalidades

- Geração de um calendário mensal para cada mês de 2024.
- Destaque visual para domingos (vermelho) e sábados (negrito).
- Destaque para o dia atual (negrito).

## Requisitos

- Servidor Web com suporte a PHP (ex: XAMPP, WAMP, LAMP, etc.).
- Navegador web para visualizar o calendário.

## Como Usar

1. **Clone ou baixe este repositório para o seu servidor web.**

2. **Abra o arquivo principal do projeto (index.php ou calendário.php) em um editor de texto.**

3. **Inicie seu servidor web.**

4. **Acesse o arquivo no navegador:**

http://localhost/seu_projeto/index.php

5. **Veja o calendário gerado para o ano de 2024.**

## Estrutura do Código

### 1. Estilo CSS

O código CSS define o estilo das células da tabela para destacar os domingos em vermelho, os sábados e o dia atual em negrito.

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
     border: 1px solid #000;
 }
 .month {
     margin-bottom: 40px;
 }
</style>

### 2. Função linha

A função linha imprime uma linha da semana. Ela aplica as classes CSS apropriadas aos domingos (vermelho), sábados (negrito) e ao dia atual (negrito).

function linha($semana, $dia_atual) {
    echo "<tr>";
    for ($i = 0; $i <= 6; $i++) {
        if (isset($semana[$i])) {
            $classes = '';

            // Verifica se o dia é domingo (índice 0)
            if ($i == 0) {
                $classes .= 'red ';
            }

            // Verifica se o dia é sábado (índice 6) ou o dia atual
            if ($i == 6 || $semana[$i] == $dia_atual) {
                $classes .= 'bold ';
            }

            // Remove espaços extras
            $classes = trim($classes);

            // Aplica as classes CSS, se houver
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

### 3. Função calendario

A função calendario gera o calendário para um mês específico. Ela calcula o dia da semana do primeiro dia do mês e preenche os dias do mês em linhas de semanas.

function calendario($mes, $ano) {
    $dia = 1;
    $semana = array();

    // Obtém o dia atual
    $dia_atual = date('Y') == $ano && date('n') == $mes ? date('j') : 0;

    // Obtém o dia da semana do primeiro dia do mês
    $dia_semana = date('w', mktime(0, 0, 0, $mes, 1, $ano));

    // Preenche os dias em branco até o primeiro dia do mês
    for ($i = 0; $i < $dia_semana; $i++) {
        array_push($semana, "");
    }

    // Preenche os dias do mês
    while ($dia <= date('t', mktime(0, 0, 0, $mes, 1, $ano))) {
        array_push($semana, $dia);

        if (count($semana) == 7) {
            linha($semana, $dia_atual);
            $semana = array();
        }
        $dia++;
    }

    // Imprime a última linha, caso tenha menos de 7 dias
    if (!empty($semana)) {
        linha($semana, $dia_atual);
    }
}

### 4. Função calendario_anual

A função calendario_anual gera o calendário para o ano inteiro. Ela itera sobre todos os meses do ano e imprime o nome do mês e o ano, além de gerar a tabela do calendário para aquele mês.

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

// Chama a função para gerar o calendário do ano de 2024
calendario_anual(2024);

## Agradecimentos

Obrigado por usar este projeto de calendário! Esperamos que ele seja útil para você.

## Referência

Este exercício está presente no capítulo 3.8 Desafios, pág. 29 do livro Desenvolvimento Web com PHP e MySQL, escrito por Evaldo Junior Bento e divulgado pela Casa do Código.