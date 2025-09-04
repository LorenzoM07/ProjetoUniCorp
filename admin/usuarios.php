<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Menu de Navegação do Admin -->
    <?php include 'menu_admin.php'; ?>

    <div class="container mt-4">
        <h2>Gestão de Usuários</h2>
        <form id="formUsuario" class="mb-4">
            <div class="row g-2">
                <div class="col-md-3">
                    <input type="text" class="form-control" id="nome" placeholder="Nome" required>
                </div>
                <div class="col-md-3">
                    <input type="email" class="form-control" id="email" placeholder="E-mail" required>
                </div>
                <div class="col-md-3">
                    <input type="password" class="form-control" id="senha" placeholder="Senha" required>
                </div>
                <div class="col-md-2">
                    <select id="papel" class="form-select">
                        <option value="usuario">Usuário</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">Salvar</button>
                </div>
            </div>
        </form>

        <div id="mensagem"></div>

        <table id="tabelaUsuarios" class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Papel</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        const baseURL = "/2IDS/ProjetoUniCorp/";

        function carregarUsuarios() {
            $.get(baseURL + "api/admin/usuarios_listar.php", function(lista){
                const tbody = $('#tabelaUsuarios tbody');
                tbody.empty();
                lista.forEach(u => {
                    tbody.append(`
                        <tr>
                            <td>${u.id}</td>
                            <td>${u.nome}</td>
                            <td>${u.email}</td>
                            <td>${u.papel}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editarUsuario('${u.id}', '${u.nome}', '${u.email}', '${u.papel}')">Editar</button>
                                <button class="btn btn-danger btn-sm" onclick="excluirUsuario('${u.id}')">Excluir</button>
                            </td>
                        </tr>
                    `);
                });
            }, 'json');
        }

       $('#formUsuario').on('submit', function(e){
            e.preventDefault(); 
            $.post(baseURL + "api/admin/usuarios_adicionar.php", {
                nome: $('#nome').val(),
                email: $('#email').val(),
                email: $('#senha').val(),
                email: $('#papel').val()
            }, function (res) {
                $('#mensagem').html(`<div class="alert alert-${res.status=='sucesso'?'sucess':'danger'}">${res.mensagem}</div>`);
                carregarUsuarios();
                $('#formUsuario')[0].reset();
            }, 'json');
       });

       function excluirUsuario (id) {
            if (confirm("Deseja excluir este usuário?")) {
                $.post(baseURL + "api/admin/usuarios_excluir.php", {id}, function(res){
                    $('#mensagem').html(`<div class="alert alert-${res.status=='sucesso'?'sucess':'danger'}">${res.mensagem}</div>`);
                    carregarUsuarios();
                }, 'json');
            }
       }
   
       function editarUsuario(id, nome, email, papel) {   
            $('#nome').val(nome);
            $('#email').val(email);
            $('#senha').val('');
            $('#papel').val(papel);
            $('#formUsuario').off('submit').on('submit', function(e) {
                e.preventDefault();
                $.post(baseURL + "api/admin/usuarios_editar.php", {
                    id, 
                    nome: $('#nome').val(),
                    email: $('#email').val(),
                    senha: $('#senha').val(),
                    papel: $('#papel').val()
                }, function(res) {
                    $('#mensagem').html(`<div class="alert alert-${res.status=='sucesso'?'sucess':'danger'}">${res.mensagem}</div>`);
                     carregarUsuarios();
                     $('#formUsuario')[0].reset();
                     $('#formUsuario').off('submit').on('submit', function (e){
                        e.preventDefault();
                        $.post(baseURL + "api/admin/usuarios_adicionar.php", {nome, email, senha, papel});
                     });

                }, 'json');
            });
       }
       $(document).ready(() => carregarUsuarios());
    </script>
</body>
</html>
