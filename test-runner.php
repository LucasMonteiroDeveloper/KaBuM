<?php

$testFiles = glob('tests/Test*.php');

foreach ($testFiles as $file) {
    require_once $file;
    $functions = get_defined_functions()['user'];
    foreach ($functions as $function) {
        if (strpos($function, 'test') === 0) {
            echo "Executando $function..." . PHP_EOL;
            $function();
            echo "$function concluído." . PHP_EOL . PHP_EOL;
        }
    }
}

echo "Todos os testes foram executados." . PHP_EOL;
