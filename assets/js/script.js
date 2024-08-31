$(document).ready(function() {
    // Máscaras para CPF e RG
    $('#addClientCPF, #editClientCPF').mask('000.000.000-00');
    $('#addClientRG, #editClientRG').mask('00.000.000-0');
    $('#addClientPhone, #editClientPhone').mask('(00) 00000-0000');
    $('#addClientCEP, #editClientCEP').mask('00000-000');
});