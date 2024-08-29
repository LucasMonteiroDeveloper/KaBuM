var app = angular.module('adminApp', []);

app.controller('AdminController', ['$scope', '$http', function($scope, $http) {
    $scope.clients = [];
    $scope.newClient = {};
    $scope.selectedClient = {};

    // Carregar clientes
    $http.get('path/to/your/api/clients.php').then(function(response) {
        $scope.clients = response.data;
    });

    // Adicionar cliente
    $scope.addClient = function() {
        $http.post('path/to/your/api/addClient.php', $scope.newClient).then(function(response) {
            $scope.clients.push(response.data);
            $('#addClientModal').modal('hide');
        });
    };

    // Editar cliente
    $scope.editClient = function(client) {
        $scope.selectedClient = angular.copy(client);
        $('#editClientModal').modal('show');
    };

    $scope.updateClient = function() {
        $http.post('path/to/your/api/updateClient.php', $scope.selectedClient).then(function(response) {
            var index = $scope.clients.findIndex(c => c.id === response.data.id);
            $scope.clients[index] = response.data;
            $('#editClientModal').modal('hide');
        });
    };

    // Excluir cliente
    $scope.deleteClient = function(id) {
        $http.post('path/to/your/api/deleteClient.php', { id: id }).then(function() {
            $scope.clients = $scope.clients.filter(c => c.id !== id);
        });
    };
}]);
