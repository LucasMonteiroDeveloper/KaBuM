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

        <div class="container">
            <div class="row">                
                <div class="col-md-12">
                    <div class="form-group search-group">
                        <input type="text" class="form-control" id="searchClient" placeholder="Digite o nome ou CPF do cliente">
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-padded table-responsive">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Data Nascimento</th>
                    <th>Endereço</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="clientsTableBody">
                <?php if (!empty($clients)): ?>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?php echo $client['Name']; ?></td>
                            <td><?php echo $client['CPF']; ?></td>
                            <td><?php echo $client['Date_Birth']; ?></td>
                            <td>
                                <?php if ($client['address_count'] > 1): ?>
                                    <button class="btn btn-sm view-addresses-btn" data-id="<?php echo $client['IdClient']; ?>">
                                        <i class="fas fa-plus"></i> Endereços
                                    </button>
                                <?php else: ?>
                                    <?php echo htmlspecialchars($client['Street']); ?>
                                <?php endif; ?>
                            </td>                         
                            <td>
                                <button class="btn btn-sm edit-btn" data-id="<?php echo $client['IdClient']; ?>">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                <button class="btn btn-sm delete-btn" data-id="<?php echo $client['IdClient']; ?>">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>                                
                            </td>
                        </tr>
                        <tr class="addresses-row" id="addresses-<?php echo $client['IdClient']; ?>" style="display: none;">
                            <td colspan="4">
                                <div id="addresses-list-<?php echo $client['IdClient']; ?>"></div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Nenhum cliente encontrado.</td>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClientModalLabel">Adicionar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addClientForm">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="addClientName">Nome</label>
                                <input type="text" class="form-control" id="addClientName" name="client[Name]" placeholder="Nome do Cliente">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="addClientDateOfBirth">Data de Nascimento</label>
                                <input type="date" class="form-control" id="addClientDateOfBirth" name="client[Date_Birth]">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="addClientCPF">CPF</label>
                                <input type="text" class="form-control" id="addClientCPF" name="client[CPF]" placeholder="CPF">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="addClientRG">RG</label>
                                <input type="text" class="form-control" id="addClientRG" name="client[RG]" placeholder="RG">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="addClientPhone">Telefone</label>
                            <input type="text" class="form-control" id="addClientPhone" name="client[Telephone]" placeholder="Telefone">
                        </div>

                        <!-- Campos para endereços -->
                        <div id="addresses-container">
                            <h5>Endereços</h5>
                            <div class="address-form">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="addresses[Street]" placeholder="Rua">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="addresses[Number]" placeholder="Número">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="addresses[City]" placeholder="Cidade">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="addresses[State]" placeholder="Estado">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="addClientCEP" class="form-control" name="addresses[CEP]" placeholder="CEP">
                                </div>
                                <button type="button" class="btn btn-danger remove-address-btn">Remover</button>
                            </div>
                        </div>
                        <button type="button" id="addAddressBtn" class="btn btn-primary">Adicionar Endereço</button>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editClientModalLabel">Editar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editClientForm">
                        <input type="hidden" id="editClientId" name="client[IdClient]">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="editClientName">Nome</label>
                                <input type="text" class="form-control" id="editClientName" name="client[Name]" placeholder="Nome do Cliente">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editClientDateOfBirth">Data de Nascimento</label>
                                <input type="date" class="form-control" id="editClientDateOfBirth" name="client[Date_Birth]">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="editClientCPF">CPF</label>
                                <input type="text" class="form-control" id="editClientCPF" name="client[CPF]" placeholder="CPF">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editClientRG">RG</label>
                                <input type="text" class="form-control" id="editClientRG" name="client[RG]" placeholder="RG">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editClientPhone">Telefone</label>
                            <input type="text" class="form-control" id="editClientPhone" name="client[Telephone]" placeholder="Telefone">
                        </div>

                        <!-- Campos para endereços -->
                        <div id="edit-addresses-container">
                            <h5>Endereços</h5>
                        </div>
                        <button type="button" id="addEditAddressBtn" class="btn btn-primary">Adicionar Endereço</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="updateClientBtn">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmação -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmação de Exclusão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir este cliente?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmDeleteBtn">Excluir</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            function filters(searchQuery = '') {
                $.ajax({
                    url: 'http://localhost/KaBuM/admin/filters',
                    method: 'GET',
                    data: { search: searchQuery },
                    dataType: 'json',
                    success: function(data) {
                        let clients = data.clients;
                        let clientsTable = '';
                        $.each(clients, function(index, client) {
                            clientsTable += `<tr>
                                <td>${client.Name}</td>
                                <td>${client.CPF}</td>
                                <td>${client.Date_Birth}</td>
                                <td>
                                    ${client.address_count > 1 ? `<button class="btn btn-sm view-addresses-btn" data-id="${client.IdClient}">
                                        <i class="fas fa-plus"></i> Endereços
                                    </button>` : client.Street}
                                </td>
                                <td>
                                    <button class="btn btn-sm edit-btn" data-id="${client.IdClient}">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                    <button class="btn btn-sm delete-btn" data-id="${client.IdClient}">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>                                
                                </td>
                            </tr>`;
                        });
                        $('#clientsTableBody').html(clientsTable);
                    },
                    error: function(xhr, status, error) {
                        console.error("Erro na requisição AJAX:", status, error);
                    }
                });
            }

            $('#searchClient').on('input', function() {
                const searchQuery = $(this).val();
                filters(searchQuery);
            });

            function loadAddresses(clientId) {
                $.ajax({
                    url: '<?php echo BASE_URL; ?>admin/getClients',
                    method: 'GET',
                    data: { id: clientId },
                    dataType: 'json',
                    success: function(data) {
                        let addressesHtml = '';
                        data.addresses.forEach(function(address) {
                            addressesHtml += `
                                <div>
                                    <p><strong>Endereço:</strong> ${address.Street}, ${address.Number}, ${address.City} - ${address.State}, ${address.CEP}</p>
                                </div>
                            `;
                        });
                        $(`#addresses-list-${clientId}`).html(addressesHtml);
                    }
                });
            }

            // Alternar visualização de endereços
            $(document).on('click', '.view-addresses-btn', function() {
                const clientId = $(this).data('id');
                const row = $(`#addresses-${clientId}`);
                if (row.is(':visible')) {
                    row.hide();
                } else {
                    loadAddresses(clientId);
                    row.show();
                }
            });

            // Adicionar novo cliente
            $('#saveClientBtn').click(function() {
                const clientData = $('#addClientForm').serialize();
                $.ajax({
                    url: '<?php echo BASE_URL; ?>admin/addClient',
                    method: 'POST',
                    data: clientData,
                    success: function(response) {
                        $('#addClientModal').modal('hide');
                        filters();
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
                        let item = client.client[0];
                        $('#editClientId').val(item.IdClient);
                        $('#editClientName').val(item.Name);
                        $('#editClientDateOfBirth').val(item.Date_Birth);
                        $('#editClientCPF').val(item.CPF);
                        $('#editClientRG').val(item.RG);
                        $('#editClientPhone').val(item.Telephone);
                        $('#editClientModal').modal('show');

                        let addressesHtml = '';
                        client.addresses.forEach(function(address) {
                            addressesHtml += `
                                <div class="address-form">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" name="addresses[Street]" value="${address.Street}" placeholder="Rua">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" name="addresses[Number]" value="${address.Number}" placeholder="Número">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" name="addresses[City]" value="${address.City}" placeholder="Cidade">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" name="addresses[State]" value="${address.State}" placeholder="Estado">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="editClientCEP" name="addresses[CEP]" value="${address.CEP}" placeholder="CEP">
                                    </div>
                                    <button type="button" class="btn btn-danger remove-address-btn">Remover</button>
                                </div>
                            `;
                        });
                        $('#edit-addresses-container').html(addressesHtml);
                        $('#editClientModal').modal('show');
                    }
                });
            });

            // Atualizar cliente
            $('#updateClientBtn').click(function() {
                const clientData = $('#editClientForm').serialize();
                $.ajax({
                    url: '<?php echo BASE_URL; ?>admin/updateClient',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        client: $('#editClientForm').serializeArray().filter(field => field.name.startsWith('client')),
                        addresses: $('#editClientForm').serializeArray().filter(field => field.name.startsWith('addresses'))
                    }),
                    success: function(response) {
                        $('#editClientModal').modal('hide');
                        filters();
                    }
                });
            });

            // Excluir cliente
            let clientIdToDelete = null;
            $(document).on('click', '.delete-btn', function() {
                clientIdToDelete = $(this).data('id');
                $('#confirmDeleteModal').modal('show');
            });

            $('#confirmDeleteBtn').click(function() {
                if (clientIdToDelete !== null) {
                    $.ajax({
                        url: '<?php echo BASE_URL; ?>admin/deleteClient',
                        method: 'POST',
                        data: { id: clientIdToDelete },
                        success: function(response) {
                            $('#confirmDeleteModal').modal('hide');
                            filters();
                        }
                    });
                }
            });

            // Adicionar novo endereço
            $('#addEditAddressBtn').click(function() {
                const addressHtml = `
                    <div class="address-form">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="addresses[Street]" placeholder="Rua">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="addresses[Number]" placeholder="Número">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="addresses[City]" placeholder="Cidade">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="addresses[State]" placeholder="Estado">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="addClientCEP" name="addresses[CEP]" placeholder="CEP">
                        </div>
                        <button type="button" class="btn btn-danger remove-address-btn">Remover</button>
                    </div>
                `;
                $('#edit-addresses-container').append(addressHtml);
            });

            // Remover endereço
            $(document).on('click', '.remove-address-btn', function() {
                $(this).closest('.address-form').remove();
            });
        });
    </script>
    <script src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</body>
</html>
