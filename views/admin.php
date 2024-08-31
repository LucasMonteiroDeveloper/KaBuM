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
                                    <i class="fa-solid fa-list"></i>
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
                                        <input type="text" class="form-control" name="addresses[0][Street]" placeholder="Rua">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="addresses[0][Number]" placeholder="Número">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="addresses[0][City]" placeholder="Cidade">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="addresses[0][State]" placeholder="Estado">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="addresses[0][CEP]" placeholder="CEP">
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

    <!-- Toasts -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
        <div class="toast-body">
            Operação realizada com sucesso!
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="errorToast" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
        <div class="toast-body">
            Ocorreu um erro. Por favor, tente novamente.
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {

            let addressIndex = 1; // Índice para novos endereços

            // Adicionar novo endereço no modal de adicionar cliente
            $('#addAddressBtn').click(function() {
                const addressHtml = `
                    <div class="address-form">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="addresses[${addressIndex}][Street]" placeholder="Rua">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="addresses[${addressIndex}][Number]" placeholder="Número">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="addresses[${addressIndex}][City]" placeholder="Cidade">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="addresses[${addressIndex}][State]" placeholder="Estado">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="addresses[${addressIndex}][CEP]" placeholder="CEP">
                        </div>
                        <button type="button" class="btn btn-danger remove-address-btn">Remover</button>
                    </div>
                `;
                $('#addresses-container').append(addressHtml);
                addressIndex++;
            });

            // Remover endereço
            $(document).on('click', '.remove-address-btn', function() {
                $(this).closest('.address-form').remove();
            });

            // Limpar o modal ao fechar
            $('#addClientModal').on('hidden.bs.modal', function() {
                $('#addClientForm')[0].reset();
                $('#addresses-container').html(`
                    <h5>Endereços</h5>
                    <div class="address-form">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="addresses[0][Street]" placeholder="Rua">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="addresses[0][Number]" placeholder="Número">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="addresses[0][City]" placeholder="Cidade">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="addresses[0][State]" placeholder="Estado">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="addresses[0][CEP]" placeholder="CEP">
                        </div>
                        <button type="button" class="btn btn-danger remove-address-btn">Remover</button>
                    </div>
                `);
                addressIndex = 1; // Resetar índice
            });

            function filters(searchQuery = '') {
                $.ajax({
                    url: '<?php echo BASE_URL; ?>admin/filters',
                    method: 'GET',
                    data: { search: searchQuery },
                    dataType: 'json',
                    success: function(data) {
                        let clients = data.clients;
                        let clientsTable = '';
                        if (clients.length > 0) {
                            $.each(clients, function(index, client) {
                                clientsTable += `<tr>
                                    <td>${client.Name}</td>
                                    <td>${client.CPF}</td>
                                    <td>${client.Date_Birth}</td>
                                    <td>
                                        ${client.address_count > 1 ? `<button class="btn btn-sm view-addresses-btn" data-id="${client.IdClient}">
                                            <i class="fa-solid fa-list"></i>
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
                                </tr>
                                <tr class="addresses-row" id="addresses-${client.IdClient}" style="display: none;">
                                    <td colspan="5">
                                        <div id="addresses-list-${client.IdClient}"></div>
                                    </td>
                                </tr>`;
                            });
                        } else {
                            clientsTable = `<tr>
                                <td colspan="5">Nenhum cliente encontrado.</td>
                            </tr>`;
                        }
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
                        if (response.success) {

                            $('#successToast').toast('show');
                            setTimeout(() => {
                                $('#successToast').toast('hide');
                            }, 5000);

                            filters(); // Atualizar lista de clientes
                        } else {
                            $('#errorToast').toast('show');
                            setTimeout(() => {
                                $('#errorToast').toast('hide');
                            }, 5000);
                        }
                        $('#addClientModal').modal('hide');
                    },
                    error: function() {
                        $('#errorToast').toast('show');
                        setTimeout(() => {
                            $('#errorToast').toast('hide');
                        }, 5000);
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
                    success: function(response) {
                        let client = response.client[0];
                        $('#editClientId').val(client.IdClient);
                        $('#editClientName').val(client.Name);
                        $('#editClientDateOfBirth').val(client.Date_Birth);
                        $('#editClientCPF').val(client.CPF);
                        $('#editClientRG').val(client.RG);
                        $('#editClientPhone').val(client.Telephone);

                        let addressesHtml = '';
                        response.addresses.forEach(function(address, index) {
                            addressesHtml += `
                                <div class="address-form" data-index="${index}">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" name="addresses[${index}][Street]" value="${address.Street}" placeholder="Rua">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" name="addresses[${index}][Number]" value="${address.Number}" placeholder="Número">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" name="addresses[${index}][City]" value="${address.City}" placeholder="Cidade">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="text" class="form-control" name="addresses[${index}][State]" value="${address.State}" placeholder="Estado">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="addresses[${index}][CEP]" value="${address.CEP}" placeholder="CEP">
                                    </div>
                                    <button type="button" class="btn btn-danger remove-address-btn" data-id="${address.IdAddress}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
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
                const formData = $('#editClientForm').serializeArray();
                const clientData = formData.filter(field => field.name.startsWith('client')).reduce((obj, field) => {
                    obj[field.name.replace('client[', '').replace(']', '')] = field.value;
                    return obj;
                }, {});

                const addressesData = formData.filter(field => field.name.startsWith('addresses')).reduce((acc, field) => {
                    const index = field.name.match(/\[(\d+)\]/)[1];
                    if (!acc[index]) acc[index] = {};
                    acc[index][field.name.replace(`addresses[${index}][`, '').replace(']', '')] = field.value;
                    return acc;
                }, []);

                $.ajax({
                    url: '<?php echo BASE_URL; ?>admin/updateClient',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        client: clientData,
                        addresses: addressesData
                    }),
                    success: function(response) {
                        $('#successToast').toast('show');
                        setTimeout(() => {
                            $('#successToast').toast('hide');
                        }, 5000);

                        $('#editClientModal').modal('hide');
                        filters();
                    },
                    error: function(){
                        $('#errorToast').toast('show');
                        setTimeout(() => {
                            $('#errorToast').toast('hide');
                        }, 5000);
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
                            $('#successToast').toast('show');
                            setTimeout(() => {
                                $('#successToast').toast('hide');
                            }, 5000);
                            $('#confirmDeleteModal').modal('hide');
                            filters();
                        },
                        error: function(){
                            $('#errorToast').toast('show');
                            setTimeout(() => {
                                $('#errorToast').toast('hide');
                            }, 5000);
                        }
                    });
                }
            });

            // Adicionar novo endereço
            $(document).on('click', '#addEditAddressBtn', function() {
                let index = $('#edit-addresses-container .address-form').length;
                let addressHtml = `
                    <div class="address-form" data-index="${index}">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="addresses[${index}][Street]" placeholder="Rua">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="addresses[${index}][Number]" placeholder="Número">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="addresses[${index}][City]" placeholder="Cidade">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="addresses[${index}][State]" placeholder="Estado">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="addresses[${index}][CEP]" placeholder="CEP">
                        </div>
                        <button type="button" class="btn btn-danger remove-address-btn">Remover</button>
                    </div>
                `;
                $('#edit-addresses-container').append(addressHtml);
            });

            // Remover endereço
            $(document).on('click', '.remove-address-btn', function() {
                const addressId = $(this).data('id');
                if (addressId) {
                    $.ajax({
                        url: '<?php echo BASE_URL; ?>admin/deleteAddress',
                        method: 'POST',
                        data: { id: addressId },
                        success: function(response) {
                            const data = JSON.parse(response);
                            if (data.success) {
                                $('#successToast').toast('show');
                                setTimeout(() => {
                                    $('#successToast').toast('hide');
                                }, 5000);
                                $(this).closest('.address-form').remove();
                                filters();
                            } else {
                                $('#errorToast').toast('show');
                                setTimeout(() => {
                                    $('#errorToast').toast('hide');
                                }, 5000);
                                filters();
                            }
                        }.bind(this)
                    });
                } else {
                    $(this).closest('.address-form').remove();
                }
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
