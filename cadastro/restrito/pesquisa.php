<?php
    include "../valida.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="CSS/estilo.css">
    <title>Pesquisar</title>
</head>

<body>
    <?php
    if (isset($_POST['busca'])) {
        $pesquisa = $_POST['busca'];
    } else {
        $pesquisa = '';
    }

    include "conexao.php";

    $sql = "SELECT * FROM pessoa WHERE nome LIKE '%$pesquisa%' ";
    $dados = mysqli_query($conexao, $sql);

    ?>


    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Pesquisa</h1>
                <nav class="navbar navbar-light bg-light">
                    <form class="form-inline" action="pesquisa.php" method="POST">
                        <input class="form-control mr-sm-2" type="search" placeholder="Nome" aria-label="Search" name="busca" autofocus>
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                    </form>
                </nav>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Foto</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Endereço</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Data de Nascimento</th>
                            <th scope="col">Funções</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        while ($linha = mysqli_fetch_assoc($dados)) {
                            $cod_pessoa = $linha['cod_pessoa'];
                            $nome = $linha['nome'];
                            $endereco = $linha['endereco'];
                            $telefone = $linha['telefone'];
                            $email = $linha['email'];
                            $data_nasc = $linha['data_nasc'];
                            $data_nasc = mostrar_data($data_nasc);                
                            $foto = $linha['foto'];
                            if(!$foto == null){
                                
                                $mostra_foto = "<img src = 'imagem/$foto' class = 'lista_foto'>";
                            }
                            else{
                                $mostra_foto = '';
                            }


                            echo "<tr>
                                    <td>$mostra_foto</td>
                                    <th scope='row'>$nome</th>
                                    <td>$endereco</td>
                                    <td>$telefone</td>
                                    <td>$email</td>
                                    <td>$data_nasc</td>
                                    <td width = 80px>
                                        <a href='cadastro_edit.php?id=$cod_pessoa' class = 'btn btn-success btn-sm'><ion-icon name='create-outline'></ion-icon></a>
                                        <a href='#' class = 'btn btn-danger btn-sm'data-toggle = 'modal' data-target ='#modal_confirma ' onclick=" . '"' . "pegar_dados($cod_pessoa, '$nome')". '"' ."><ion-icon name='trash-outline'></ion-icon></a>
                                    </td>
                            
                                </tr>";
                        }

                        ?>



                    </tbody>
                </table>
                <a href="index.php" class="btn btn-primary">Voltar ao Inicio</a>
            </div>
        </div>
    </div>

    <!-- modal -->
    <div class="modal" id="modal_confirma" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmação de exclusão</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="excluir_script.php" method="POST">
        <p>Deseja realmente excluir?</p>
        <p id="nome_pessoa">nome pessoa</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Não</button>
        <input type="hidden" name="nome" id="nome_pessoa_1" value="">               
        <input type="hidden" name="id" id="cod_pessoa" value="">               
        <input type="submit" class="btn btn-danger" value="Sim" >
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    function pegar_dados(id, nome){
        document.getElementById('nome_pessoa').innerHTML = nome;
        document.getElementById('nome_pessoa_1').value = nome;
        document.getElementById('cod_pessoa').value = id;
    }
</script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>

</html>