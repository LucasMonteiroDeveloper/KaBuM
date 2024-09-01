### Visão Geral

Este README fornece instruções detalhadas sobre como iniciar, executar e testar o projeto. Este projeto é um sistema em PHP puro em MVC com MySQL como banco de dados.

## Inicialização do Projeto
Siga os passos abaixo para configurar e iniciar o projeto:

## Clonar o Repositório
Clone o repositório para o seu ambiente local:
```
gh repo clone LucasMonteiroDeveloper/TechnicalChallenge-Kabum
```

## Configurar o Banco de Dados
Criei um banco de dados MySQL para o projeto. Rode os scripts para a criação e inserção do banco de dados no arquivo database-kabum.txt.

Exemplo de configuração presente nesse banco
```ruby
    'host' => 'localhost',
    'dbname' => 'kabum',
    'dbuser' => 'root',
    'dbpass' => '',
```

## Login
Se você executou o script de inserção, haverá dois logins ativos para sua sessão, que são:
```ruby
    Login: fulano@gmail.com
    Senha: teste
```
Caso contrário, você pode se registrar e adicionar novos usuários conforme necessário.

## Iniciar o Servidor Web
Inicie o servidor web embutido do PHP para começar e testar a aplicação. No meu caso, utilizei o XAMPP para esse propósito.
A aplicação estará disponível em
```ruby
http://localhost/KaBuM/
```

## Executando Testes
Optei por não utilizar um framework para manter o processo mais manual. Embora o PHPUnit pudesse facilitar a manipulação e automação dos testes, optei por utilizar asserções simples em scripts PHP nativos. Essa abordagem é mais manual, mas continua sendo eficaz para pequenos projetos.

#### Comanda de Execução
 Abra o terminal, navegue até o diretório do projeto e execute o seguinte comando para rodar todos os testes:
```
php test-runner.php
```
#### Saída
  Se todos os testes passarem, não haverá saída adicional, exceto as mensagens que você definiu no script. Caso algum teste falhe, o assert() irá interromper o script e exibir uma mensagem de erro.

#### Como Funciona
Os arquivos de teste estão dentro da pasta 'tests/'.

Test Runner: O test-runner.php é responsável por carregar todos os arquivos de teste e executar as funções que começam com test.

Execução: Cada função de teste verifica um aspecto específico do seu código, utilizando assert() para validar os resultados esperados.
