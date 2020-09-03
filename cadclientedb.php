<?php
    // var_dump($_POST);
    // var_dump($_FILES)

    //Recebendo os dados enviados pelo formulário
    $Nome = $_POST["txtNome"];
    $CPF = $_POST["txtCPF"];
    $Endereco = $_POST["txtEndereco"];
    $Estado = $_POST["listEstados"];
    $DataNascimento = $_POST["textDataNascimento"];
    $Sexo = $_POST["listSexo"];
    $Login = $_POST["txtLogin"];
    $Senha = $_POST["txtSenha"];
    $ConfirmaSenha = $_POST["txtConfirmaSenha"]; 
    $arquivo = $_FILES["txtFoto"];
    $camposOK = true;   

    //Verificando a Senha - Ambas devem ser iguais    
    if ( $Senha != $ConfirmaSenha ){
        header("location:formularioCadastro.php?erro= Senha e Confirmação de Senha estão diferentes");
        echo "<h6>As senhas não conferem!</h6>";
            $camposOK = false;
        die();    
    }   
    
    // Verificando se o arquivo foi enviado
        if ($arquivo['size'] == 0){
        echo '<h6>Erro no arquivo. Tamanho igual a ZERO.</h6>';
        $camposOK = false;
    } 
    // Verificando o tamanho do arquivo
    if ($arquivo['size'] > 200000){
        echo '<h6>Tamanho maior que o permitido (200 KBytes).</h6>';
        $camposOK = false;
    }  
    // Verificando o tipo do arquivo
    if (
            ($arquivo['type'] != "image/gif")&&
            ($arquivo['type'] != "image/jpeg")&&
            ($arquivo['type'] != "image/pjpeg")&&
            ($arquivo['type'] != "image/png")&&
            ($arquivo['type'] != "image/bmp")
            ){
                echo '<h6>Erro no arquivo. TIPO não Permitido.</h6>'; 
                $camposOK = false;
            } 
    // Verificando se os capmos forma preenchidos 
    if ($camposOK) {
        // Move o arquivo para a pasta destino 
        $destino = "imagens/";
        $destino = $destino.$arquivo['name'];
        $res= move_uploaded_file($arquivo['tmp_name'], $destino);
    // Erro ao copiar o arquivo de imagem
    if ($res==false){
        echo "<h1>Erro ao copiar o arquivo para o destino.</h1>";
    } else 
    
    {
        echo "<h5>Os dadosenviados do Formulário</h5>";
        echo "<img height=120 width=120 src='imagens/" . $arquivo['name'] . "'>"; 
        echo "<table border='0' cellpadding='5'>";    
        echo "<tr><td>Nome:</td><td><b>$Nome</b></td></tr>";  
        echo "<tr><td>Endereço:</td><td><b>$Endereco</b></td></tr>";    
        echo "<tr><td>CPF:</td><td><b>$CPF</b></td></tr>"; 
        echo "<tr><td>Data de Nascimento:</td><td><b>$DataNascimento</b></td></tr>";
        echo "<tr><td>Estado:</td><td><b>$Estado</b></td></tr>";
        echo "<tr><td>Sexo:</td><td><b>$Sexo</b></td></tr>";
        echo "<tr><td>Login:</td><td><b>$Login</b></td></tr>";
        echo "<tr><td>Senha:</td><td><b>$Senha</b></td></tr>";
        echo "<tr><td>Confirma Senha:</td><td><b>$ConfirmaSenha</b></td></tr>";
        echo "</b></td></tr></table>";
    }    
    }
    
    // ------------ CONEXÃO COM O BD ------------
    // Parâmetros de conexão
    $servidor = 'localhost';
    $usuario = 'root';
    $senha = '';
    $banco = 'progwebdb';
    $Id = null;

    try{
        // Conecta com o Banco de Dados MySQL    
        $mysqli = new mysqli($servidor, $usuario, $senha, $banco);
        // Caso a conexão dê erro, exibirá uma mensagem de erro
        if (mysqli_connect_errno()) trigger_error(mysqli_connect_errno());

        if ($mysqli){
            echo "Conexão bem sucedida com o mysqli!";
        
            // ------------ INSERT ------------
            $sql = "insert into clientes values('".$Id."', '".$Estado."', '".$Nome."', '".$CPF."', '".$Endereco."', 
            '".$DataNascimento."', '".$Sexo."', '".$Login."', '".$Senha."')";
            $query = $mysqli -> prepare($sql);
            $query ->execute();
            if (!$query) {
                $dados = array('mensage' => "Não foi possível enviar os dados!");
                echo json_encode($dados);
            }else{
                $dados = array('mensage' => "Os dados foram enviados com sucesso!");
                echo json_encode($dados);
            };
        
            // ------------ SELECT ------------
            $sql = "Select * from clientes";
            // $sql = "select 'IdClientes', 'estado_sigla', 'nome', 'cpf', 'endereco', 'dtNascimento', 'sexo', 
            // 'login', 'senha' from clientes where 1=1"

            $retorno = $mysqli->query($sql);
            echo "<h5>DADOS RETORNADOS DO BANCO DE DADOS</h5>";
            echo "<table border='1'>";
            echo "<tr>";
            echo "<td>Código</td>"; 
            echo "<td>Nome</td>"; 
            echo "<td>Endereço</td>"; 
            echo "<td>CPF</td>"; 
            echo "<td>Data Nascimento</td>"; 
            echo "<td>Estado</td>"; 
            echo "<td>login</td>"; 
            echo "<td>Sexo</td>";
            echo "</tr>";            
            while ($registro = $retorno->fetch_array()){
                $retId = $registro["IdClientes"];
                $retEstado = $registro["estado_sigla"];
                $retNome = $registro["nome"];
                $retCPF = $registro["cpf"];
                $retEndereco = $registro["endereco"];
                $retDtNascimento = $registro["dtNascimento"];
                $retSexo = $registro["sexo"];
                $retLogin = $registro["login"];
                $retSenha = $registro["senha"];

                echo "<tr>";
                // echo "<img height=120 width=120 src='imagens/" . $arquivo['name'] . "'>";  
                echo "<td><b> $retId</b></td>";  
                echo "<td><b> $retNome</b></td>";  
                echo "<td><b> $retEndereco</b></td>";    
                echo "<td><b> $retCPF</b></td>"; 
                echo "<td><b> $retDtNascimento</b></td>";
                echo "<td><b> $retEstado</b></td>";
                echo "<td><b> $retLogin</b></td>";
                echo "<td><b> $retSexo</b></td>";
                echo "</tr>";
            }     
            echo "</table>";    
            die("Consulta realizada e registros existentes retornados!");
        }
    else{ 
            $dados = array('mensage' => "Não foi possível inserir os dados! Por favor, tente novamente mais tarde!");
            echo json_encode($dados);
        };
    }catch(Exception $ex) {
        echo "erro ao listar: ". $ex->getMessage();
    };            
?>