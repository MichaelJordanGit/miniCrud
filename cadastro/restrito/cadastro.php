<?php
    include "../valida.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/estilo.css">
    <title>Cadastro</title>
</head>
<body>
    <div class="container">
        <div class="row">
        <?php
            include "conexao.php";

            $nome = $_POST['nome'];
            $endereco = $_POST['endereco'];
            $telefone =  $_POST['telefone'];
            $email = $_POST['email'];
            $data_nasc = $_POST['data_nasc'];

            $foto = $_FILES['foto'];
            $nome_foto = mover_foto($foto);
            if ($nome_foto == 0) {
                $nome_foto = null;
            }


            $sql = "INSERT INTO `pessoa`(`nome`, `endereco`, `telefone`, `email`, `data_nasc`, `foto`)
                    VALUES ('$nome','$endereco','$telefone','$email','$data_nasc', '$nome_foto')";

            if(mysqli_query($conexao, $sql)){
                if($nome_foto != null){
                    echo "<img src='imagem/$nome_foto' title='$nome_foto' class='mostrar_foto' >";
                }
                mensagem("$nome cadastrado com sucesso",'success');
            }        
            else{
                mensagem("$nome não cadastrado", 'danger');
            }
        ?>
        <hr>
        <a href="index.php" class="btn btn-primary">Voltar</a>

            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>
</html>