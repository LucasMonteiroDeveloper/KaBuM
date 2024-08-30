<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo BASE_URL; ?>">Administração</a>
    </nav>

    <div class="container mt-5">
        <h2>Gerenciador de Clientes</h2>

        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Data Nascimento</th>
                    <th>CPF</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="clientsTableBody">
                <?php if (!empty($clients)): ?>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?php echo $client['IdClient']; ?></td>
                            <td><?php echo $client['Name']; ?></td>
                            <td><?php echo $client['Date_Birth']; ?></td>
                            <td><?php echo $client['CPF']; ?></td>
                            <td>
                            <button class="btn btn-warning btn-sm edit-btn" data-id="<?php echo $client['IdClient']; ?>">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $client['IdClient']; ?>">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Nenhum cliente encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="add-client-button">
        <button class="btn btn-primary btn-circle" data-toggle="modal" data-target="#addClientModal">
            <i class="fas fa-plus"></i>
        </button>
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
                    <form id="addClientForm">
                        <div class="form-group">
                            <label for="addClientName">Nome</label>
                            <input type="text" class="form-control" id="addClientName" name="Name">
                        </div>
                        <div class="form-group">
                            <label for="addClientDateOfBirth">Data de Nascimento</label>
                            <input type="date" class="form-control" id="addClientDateOfBirth" name="Date_Birth">
                        </div>
                        <div class="form-group">
                            <label for="addClientCPF">CPF</label>
                            <input type="text" class="form-control" id="addClientCPF" name="CPF">
                        </div>
                        <div class="form-group">
                            <label for="addClientRG">RG</label>
                            <input type="text" class="form-control" id="addClientRG" name="RG">
                        </div>
                        <div class="form-group">
                            <label for="addClientPhone">Telefone</label>
                            <input type="text" class="form-control" id="addClientPhone" name="Phone">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="saveClientBtn">Salvar</button>
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
                    <form id="editClientForm">
                        <input type="hidden" id="editClientId" name="id">
                        <div class="form-group">
                            <label for="editClientName">Nome</label>
                            <input type="text" class="form-control" id="editClientName" name="Name">
                        </div>
                        <div class="form-group">
                            <label for="editClientDateOfBirth">Data de Nascimento</label>
                            <input type="date" class="form-control" id="editClientDateOfBirth" name="Date_Birth">
                        </div>
                        <div class="form-group">
                            <label for="editClientCPF">CPF</label>
                            <input type="text" class="form-control" id="editClientCPF" name="CPF">
                        </div>
                        <div class="form-group">
                            <label for="editClientRG">RG</label>
                            <input type="text" class="form-control" id="editClientRG" name="RG">
                        </div>
                        <div class="form-group">
                            <label for="editClientPhone">Telefone</label>
                            <input type="text" class="form-control" id="editClientPhone" name="Phone">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="updateClientBtn">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Inclua o jQuery completo e outros scripts no final -->
    <!-- <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.7.1.min.js"></script> -->
    <script>
        $(document).ready(function() {
            // Máscaras para CPF e RG
            $('#addClientCPF, #editClientCPF').mask('000.000.000-00');
            $('#addClientRG, #editClientRG').mask('00.000.000-0');

            // Função para carregar os clientes
            function loadClients() {
                $.ajax({
                    url: '<?php echo BASE_URL; ?>controllers/adminController.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        let clientsHtml = '';
                        data.clients.forEach(function(client) {
                            clientsHtml += `
                                <tr>
                                    <td>${client.IdClient}</td>
                                    <td>${client.Name}</td>
                                    <td>${client.Date_Birth}</td>
                                    <td>${client.CPF}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm edit-btn" data-id="${client.IdClient}">Editar</button>
                                        <button class="btn btn-danger btn-sm delete-btn" data-id="${client.IdClient}">Excluir</button>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#clientsTableBody').html(clientsHtml);
                    }
                });
            }

            loadClients();

            // Adicionar novo cliente
            $('#saveClientBtn').click(function() {
                const clientData = $('#addClientForm').serialize();
                $.ajax({
                    url: '<?php echo BASE_URL; ?>admin/addClient',
                    method: 'POST',
                    data: clientData,
                    success: function(response) {
                        $('#addClientModal').modal('hide');
                        loadClients();
                    }
                });
            });

            // Editar cliente
            $(document).on('click', '.edit-btn', function() {
                const clientId = $(this).data('id');
                $.ajax({
                    url: '<?php echo BASE_URL; ?>admin/getClients',
                    method: 'GET',
                    data: { id: clientId },
                    dataType: 'json',
                    success: function(client) {
                        let item = client[0];
                        $('#editClientId').val(item.IdClient);
                        $('#editClientName').val(item.Name);
                        $('#editClientDateOfBirth').val(item.Date_Birth);
                        $('#editClientCPF').val(item.CPF);
                        $('#editClientRG').val(item.RG);
                        $('#editClientPhone').val(item.Telephone);
                        $('#editClientModal').modal('show');
                    }
                });
            });

            // Atualizar cliente
            $('#updateClientBtn').click(function() {
                const clientData = $('#editClientForm').serialize();
                $.ajax({
                    url: '<?php echo BASE_URL; ?>controllers/adminController.php?action=update',
                    method: 'POST',
                    data: clientData,
                    success: function(response) {
                        $('#editClientModal').modal('hide');
                        loadClients();
                    }
                });
            });

            // Excluir cliente
            $(document).on('click', '.delete-btn', function() {
                const clientId = $(this).data('id');
                if (confirm('Tem certeza que deseja excluir este cliente?')) {
                    $.ajax({
                        url: '<?php echo BASE_URL; ?>admin/deleteClient',
                        method: 'POST',
                        data: { id: clientId },
                        success: function(response) {
                            loadClients();
                        }
                    });
                }
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</body>
</html>
