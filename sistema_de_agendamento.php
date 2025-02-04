<?php

//função para carregar os eventos do arquivo JSON
function carregarEventos() {
    if (file_exists('eventos.json')) {
        $conteudo = file_get_contents('eventos.json');
        return json_decode($conteudo, true);
    }
    return [];
}

//função para salvar os eventos no arquivo JSON
function salvarEventos($eventos) {
    file_put_contents('eventos.json', json_encode($eventos, JSON_PRETTY_PRINT));
}

//função para listar eventos
function listarEventos($eventos) {
    if (empty($eventos)) {
        echo "\nNenhum evento cadastrado.\n";
    } else {
        echo "\n=== Lista de Eventos ===\n";
        foreach ($eventos as $indice => $evento) {
            echo "[" . ($indice + 1) . "] Data: {$evento['data']} - Hora: {$evento['hora']} - Local: {$evento['local']} - Descrição: {$evento['descricao']}\n";
        }
    }
}

//função para adicionar um evento
function adicionarEvento(&$eventos) {
    echo "\nDigite a data do evento (formato: YYYY-MM-DD): ";
    $data = trim(fgets(STDIN));

    echo "Digite a hora do evento (formato: HH:MM): ";
    $hora = trim(fgets(STDIN));

    echo "Digite o local do evento: ";
    $local = trim(fgets(STDIN));

    echo "Digite uma descrição para o evento: ";
    $descricao = trim(fgets(STDIN));

    echo "O evento é recorrente? (s/n): ";
    $recorrente = strtolower(trim(fgets(STDIN))) === 's';

    if ($recorrente) {
        echo "Informe o intervalo da recorrência (em dias): ";
        $intervalo = (int) trim(fgets(STDIN));

        echo "Quantas vezes o evento deve se repetir?: ";
        $repeticoes = (int) trim(fgets(STDIN));

        for ($i = 0; $i < $repeticoes; $i++) {
            $novaData = date('Y-m-d', strtotime("$data +$i days"));
            $eventos[] = ['data' => $novaData, 'hora' => $hora, 'local' => $local, 'descricao' => $descricao];
        }
    } else {
        $eventos[] = ['data' => $data, 'hora' => $hora, 'local' => $local, 'descricao' => $descricao];
    }

    salvarEventos($eventos);
    echo "\nEvento(s) adicionado(s) com sucesso!\n";
}

//função para remover um evento
function removerEvento(&$eventos) {
    listarEventos($eventos);

    if (!empty($eventos)) {
        echo "\nDigite o número do evento que deseja remover: ";
        $indice = (int) trim(fgets(STDIN)) - 1;

        if (isset($eventos[$indice])) {
            unset($eventos[$indice]);
            $eventos = array_values($eventos); // Reorganiza os índices do array
            salvarEventos($eventos);
            echo "\nEvento removido com sucesso!\n";
        } else {
            echo "\nEvento não encontrado.\n";
        }
    }
}

//função para editar um evento
function editarEvento(&$eventos) {
    listarEventos($eventos);

    if (!empty($eventos)) {
        echo "\nDigite o número do evento que deseja editar: ";
        $indice = (int) trim(fgets(STDIN)) - 1;

        if (isset($eventos[$indice])) {
            echo "Digite a nova data do evento (formato: YYYY-MM-DD) ou pressione Enter para manter: ";
            $novaData = trim(fgets(STDIN));
            if (!empty($novaData)) {
                $eventos[$indice]['data'] = $novaData;
            }

            echo "Digite a nova hora do evento (formato: HH:MM) ou pressione Enter para manter: ";
            $novaHora = trim(fgets(STDIN));
            if (!empty($novaHora)) {
                $eventos[$indice]['hora'] = $novaHora;
            }

            echo "Digite o novo local do evento ou pressione Enter para manter: ";
            $novoLocal = trim(fgets(STDIN));
            if (!empty($novoLocal)) {
                $eventos[$indice]['local'] = $novoLocal;
            }

            echo "Digite a nova descrição do evento ou pressione Enter para manter: ";
            $novaDescricao = trim(fgets(STDIN));
            if (!empty($novaDescricao)) {
                $eventos[$indice]['descricao'] = $novaDescricao;
            }

            salvarEventos($eventos);
            echo "\nEvento editado com sucesso!\n";
        } else {
            echo "\nEvento não encontrado.\n";
        }
    }
}

//função para buscar eventos por data
function buscarEventoPorData($eventos) {
    echo "\nDigite a data para buscar eventos (formato: YYYY-MM-DD): ";
    $dataBusca = trim(fgets(STDIN));

    $encontrados = array_filter($eventos, function ($evento) use ($dataBusca) {
        return $evento['data'] === $dataBusca;
    });

    if (empty($encontrados)) {
        echo "\nNenhum evento encontrado para a data informada.\n";
    } else {
        echo "\n=== Eventos Encontrados ===\n";
        foreach ($encontrados as $evento) {
            echo "Data: {$evento['data']} - Hora: {$evento['hora']} - Local: {$evento['local']} - Descrição: {$evento['descricao']}\n";
        }
    }
}

//menu principal
function exibirMenu() {
    echo "\n========================\n";
    echo "    Sistema de Agenda   \n";
    echo "========================\n";
    echo "1. Listar eventos\n";
    echo "2. Adicionar evento\n";
    echo "3. Remover evento\n";
    echo "4. Editar evento\n";
    echo "5. Buscar eventos por data\n";
    echo "6. Sair\n";
    echo "Escolha uma opção: ";
}

//programa principal
$eventos = carregarEventos();

while (true) {
    exibirMenu();
    $opcao = trim(fgets(STDIN));

    switch ($opcao) {
        case '1':
            listarEventos($eventos);
            break;
        case '2':
            adicionarEvento($eventos);
            break;
        case '3':
            removerEvento($eventos);
            break;
        case '4':
            editarEvento($eventos);
            break;
        case '5':
            buscarEventoPorData($eventos);
            break;
        case '6':
            echo "\nSaindo do sistema. Até logo!\n";
            exit;
        default:
            echo "\nOpção inválida. Tente novamente.\n";
    }
}

?>
