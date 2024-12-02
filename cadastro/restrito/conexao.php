
<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $bd = "empresa";

    if($conexao = mysqli_connect($server, $user, $pass, $bd)){
       // echo 'Conectado!!!';
    }
    else{
        echo 'Erro de conexão com banco de dados!!!';
    }

    function mensagem($texto, $tipo){
       echo"<div class='alert alert-$tipo' role='alert'>
        $texto
       </div>";
    }

    function mostrar_data($data){
        $d = explode('-', $data);
        $escreve = $d[2].'/'.$d[1].'/'.$d[0];
        return $escreve;
    }
    function mover_foto($vetor_foto){
        $vtipo =  explode("/", $vetor_foto['type']);
        $tipo = $vtipo[0] ?? '';
        $extensao = isset($vtipo[1]) ? "." . $vtipo[1] : '';
        if ((!$vetor_foto['error']) and ($vetor_foto['size'] <=1000000 )and($tipo == "image")) {
            $nome_arquivo = date('Ymdhms').$extensao;
            move_uploaded_file($vetor_foto['tmp_name'], "imagem/".$nome_arquivo);
            return $nome_arquivo;
        }
        else{ 
            return 0;
        }
    }
    
?>