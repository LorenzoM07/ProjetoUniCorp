<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Cursos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Menu de Navegação do Admin -->
    <?php include 'menu_admin.php'; ?>

    <div class="container mt-4">
        <h2>Gestão de Cursos</h2>
        <form id="formCursos" class="mb-4">
            <div class="row g-2">
                <div class="col-md-3">
                    <input type="text" class="form-control" id="nome" placeholder="Nome do Curso" required>
                </div>
                <div class="col-md-6">
                    <input type="descriçao" class="form-control" id="descriçao" placeholder="Descriçao">
                </div>
                <div class="col-md-2">
                    <select id="status" class="form-select">
                        <option value="curso">Ativo</option>
                        <option value="admin">Inativo</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">Salvar</button>
                </div>
            </div>
        </form>

        <div id="mensagem"></div>

        <table id="tabelaCursos" class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descriçao</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        const baseURL = "/2IDS/ProjetoUniCorp/";

        function carregarCursos() {
            $.get(baseURL + "api/admin/cursos_listar.php", function(lista) {
                const tbody = $('#tabelaCursos tbody');
                tbody.empty();
                lista.forEach(u => {
                    tbody.append(`
                        <tr>
                            <td>${u.id}</td>
                            <td>${u.nome}</td>
                            <td>${u.descricao}</td>
                            <td>${u.status}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editarCursos('${u.id}', '${u.nome}', '${u.descricao}', '${u.status}')">Editar</button>
                                <button class="btn btn-danger btn-sm" onclick="excluirCursos('${u.id}')">Excluir</button>
                                
                            </td>
                        </tr>
                    `);
                });
            }, 'json');
        }

       $('#formCursos').on('submit', function(e) {
            e.preventDefault(); 
            $.post(baseURL + "api/admin/cursos_adicionar.php", {
                nome: $('#nome').val(),
                descricao: $('#descricao').val(),
                status: $('#status').val(),

            }, function (res) {
                $('#mensagem').html(`<div class="alert alert-${res.status=='sucesso'?'success':'danger'}">${res.mensagem}</div>`);
                carregarCursos();
                $('#formCursos')[0].reset();
            }, 'json');
       });

       function excluirCursos (id) {
            if (confirm("Deseja excluir este curso?")) {
                $.post(baseURL + "api/admin/cursos_excluir.php", {id}, function(res){
                    $('#mensagem').html(`<div class="alert alert-${res.status=='sucesso'?'sucess':'danger'}">${res.mensagem}</div>`);
                    carregarCursos();
                }, 'json');
            }
       }
   
       function editarCursos(id, nome, descricao, status) {   
            $('#nome').val(nome);
            $('#descricao').val(descricao);
            $('#status').val(status);
            $('#formCursos').off('submit').on('submit', function(e) {
                e.preventDefault();
                $.post(baseURL + "api/admin/cursos_editar.php", {
                    id, 
                    nome: $('#nome').val(),
                    descricao: $('#descricao').val(),
                    status: $('#status').val(),
                }, function(res) {
                    $('#mensagem').html(`<div class="alert alert-${res.status=='sucesso'?'sucess':'danger'}">${res.mensagem}</div>`);
                     carregarCursos();
                     $('#formCursos')[0].reset();
                     $('#formCursos').off('submit').on('submit', function (e){
                        e.preventDefault();
                        $.post(baseURL + "api/admin/cursos_adicionar.php", {nome, descricao, status});
                     });

                }, 'json');
            });
       }
       $(document).ready(() => carregarCursos());
    </script>
</body>
</html>

