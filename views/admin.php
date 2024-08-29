<!DOCTYPE html>
<html lang="pt-BR" ng-app="adminApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>

    <script src="<?php echo BASE_URL; ?>assets/js/app.js"></script>
</head>
<body ng-controller="AdminController">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo BASE_URL; ?>">Administração</a>
    </nav>

    <div class="container mt-5">
        <h2>Gerenciador de Clientes</h2>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addClientModal">Adicionar Cliente</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Data Nascimento</th>
                    <th>CPF</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="client in clients">
                    <td>{{ client.id }}</td>
                    <td>{{ client.name }}</td>
                    <td>{{ client.email }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" ng-click="editClient(client)">Editar</button>
                        <button class="btn btn-danger btn-sm" ng-click="deleteClient(client.id)">Excluir</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal para Adicionar Cliente -->
    <div class="modal fade" id="addClientModal" tabindex="-1" role="dialog" aria-labelledby="addClientModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClientModalLabel">Adicionar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="clientName">Nome</label>
                            <input type="text" class="form-control" id="clientName" ng-model="newClient.name">
                        </div>
                        <div class="form-group">
                            <label for="clientEmail">Data de Nascimento</label>
                            <input type="email" class="form-control" id="clientEmail" ng-model="newClient.email">
                        </div>
                        <div class="form-group">
                            <label for="clientEmail">CPF</label>
                            <input type="email" class="form-control" id="clientEmail" ng-model="newClient.email">
                        </div>
                        <div class="form-group">
                            <label for="clientEmail">RG</label>
                            <input type="email" class="form-control" id="clientEmail" ng-model="newClient.email">
                        </div>
                        <div class="form-group">
                            <label for="clientEmail">Telefone</label>
                            <input type="email" class="form-control" id="clientEmail" ng-model="newClient.email">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" ng-click="addClient()">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Cliente -->
    <div class="modal fade" id="editClientModal" tabindex="-1" role="dialog" aria-labelledby="editClientModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editClientModalLabel">Editar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="editClientName">Nome</label>
                            <input type="text" class="form-control" id="editClientName" ng-model="selectedClient.name">
                        </div>
                        <div class="form-group">
                            <label for="editClientEmail">Email</label>
                            <input type="email" class="form-control" id="editClientEmail" ng-model="selectedClient.email">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" ng-click="updateClient()">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
