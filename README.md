# Sistema de Gerenciamento de Agenda em PHP

## Visão Geral:
Este código implementa um sistema de gerenciamento de agenda, permitindo o cadastro, edição, remoção e busca de eventos por data. Os eventos são armazenados em um arquivo JSON, garantindo a persistência dos dados entre execuções. O sistema é interativo, funcionando por meio de linha de comando (CLI).

## Requisitos:
- PHP 7.x ou superior.
- Ambiente de execução com suporte a CLI (por exemplo, terminal ou console).
- Arquivo `eventos.json` para armazenar os eventos cadastrados.

## Funcionalidades:
O sistema oferece as seguintes opções:

1. **Listar Eventos**: Mostra todos os eventos cadastrados com informações como data, hora, local e descrição.
2. **Adicionar Evento**: Permite o cadastro de novos eventos, incluindo a opção de recorrência (eventos repetidos a cada intervalo de dias).
3. **Remover Evento**: Exclui um evento selecionado da lista.
4. **Editar Evento**: Modifica os dados de um evento já cadastrado.
5. **Buscar Evento por Data**: Filtra e exibe os eventos agendados para uma data específica.
6. **Sair**: Finaliza a execução do programa.

### Entrada de Dados:
O sistema solicita dados do usuário para cada operação, como:
- Data (formato: YYYY-MM-DD)
- Hora (formato: HH:MM)
- Local do evento
- Descrição detalhada
- Configurações de recorrência (se aplicável)

### Exemplo de Fluxo de Execução:

```shell
========================
    Sistema de Agenda   
========================
1. Listar eventos
2. Adicionar evento
3. Remover evento
4. Editar evento
5. Buscar eventos por data
6. Sair
Escolha uma opção: 2

Digite a data do evento (formato: YYYY-MM-DD): 2025-02-03
Digite a hora do evento (formato: HH:MM): 14:00
Digite o local do evento: Escritório
Digite uma descrição para o evento: Reunião de planejamento
O evento é recorrente? (s/n): n

Evento(s) adicionado(s) com sucesso!
```

## Estrutura do Código:
O programa é estruturado em funções para melhor organização e manutenção:

- **carregarEventos()**: Carrega os eventos armazenados no arquivo JSON.
- **salvarEventos($eventos)**: Salva a lista de eventos no arquivo JSON.
- **listarEventos($eventos)**: Exibe todos os eventos cadastrados.
- **adicionarEvento(&$eventos)**: Adiciona um novo evento à lista.
- **removerEvento(&$eventos)**: Remove um evento selecionado pelo usuário.
- **editarEvento(&$eventos)**: Permite modificar os detalhes de um evento existente.
- **buscarEventoPorData($eventos)**: Busca e exibe eventos para uma data específica.
- **exibirMenu()**: Exibe o menu principal e captura a opção selecionada pelo usuário.

## Como Usar:
1. **Executar o código** no terminal usando o comando:
   ```bash
   php nome_do_arquivo.php
   ```
2. **Interagir com o sistema** selecionando as opções do menu e fornecendo os dados solicitados.
3. **Gerenciar eventos** conforme as opções disponíveis (listar, adicionar, editar, etc.).

## Link para execução online:
Você também pode executar o código diretamente no [OnlineGDB](https://onlinegdb.com/L9hjDzF2N).

---
