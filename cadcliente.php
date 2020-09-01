<html>
    <head>
        <meta http-equiv="Content-Type" Content="text/html; charset=UTF-8"
        <title>Cadastro de Clientes</title>
    </head>
    <body>
        <h1>Os dados informados são:</h1>
        <?php 
            //Obtendo a foto
            $arquivo = $_FILES["txtFoto"];
            
            // Verificando erro no upload
            if ($arquivo['error'] != 0){
                echo 'Erro no UPLOAD do arquivo. <br>';
                $camposOK = false;
            }

            // Verificando o tamanho
            if ($arquivo['size'] == 0){
                echo 'Erro no arquivo. Tamanho igual a ZERO. <br>';
                $camposOK = false;
            }            
            if ($arquivo['size'] > 100000){
                echo 'Tamanho maior que o permitido (100 KBytes). <br>';
                $camposOK = false;
            }              
            
            // Verificando o tipo do arquivo
            if (($arquivo['type'] != "image/gif")&&
                ($arquivo['type'] != "image/jpg")&&
                ($arquivo['type'] != "image/jpeg")&&
                ($arquivo['type'] != "image/pjpeg")&&
                ($arquivo['type'] != "image/x-png")&&
                ($arquivo['type'] != "image/png")&&
                ($arquivo['type'] != "image/bmp")) {
                echo "Erro no arquivo. TIPO não Permitido.<br>"; 
                $camposOK = false;
            }        
            // Movendo o arquivo para algumdiretório válido
            // dentro do www
            $destino = "c:/wamp64/www/cadastros/imagens/";
            $destino = $destino . $arquivo['name'];
            $res= move_uploaded_file($arquivo['tmp_name'], $destino);
            if ($res==false){
                echo "Erro ao copiar o arquivo para o destino.<br>";
                $camposOK = false;
            }
            
                        
            
            //Recebe cada campo do formulário
            // e coloca em uma variável
            $nome = $_POST["txtNome"];
            $ender = $_POST["txtEndereco"];
            $cpf = $_POST["txtCPF"];
            $estado = $_POST["listEstados"];
            $dtNasc = $_POST["txtData"];
            $sexo = $_POST["sexo"];
            $interesse = $_POST["interesse"];
            $login = $_POST["txtLogin"];
            $senha1 = $_POST["txtSenha1"];
            $senha2 = $_POST["txtSenha2"];

            //verificar campos 
            $camposOK = true; //Determina se ocorreu erro 
            if ( $nome == "" ){
                echo "Informe o Nome. <br>";
                $camposOK = false;
            }
            if ( $ender == "" ){
                echo "Informe o Endereço. <br>";
                $camposOK = false;
            }            
            if ( $cpf == "" ){
                echo "Informe o CPF. <br>";
                $camposOK = false;
            }            
            if ( $dtNasc == "" ){
                echo "Informe a Data de Nascimento. <br>";
                $camposOK = false;
            }            
            if ( $login == "" ){
                echo "Informe o login. <br>";
                $camposOK = false;
            }            
            // Verificar se as senhas conferem
            if ( $senha1 != $senha2 ){
                echo "As senhas não conferem!<br>";
                $camposOK = false;
            }              

            // Mostrando os valores em forma de tabela
            // Cada campo é uma lista <tr> da tabela 
            if ($camposOK){
                echo "<table border='0' cellpadding='5'>";
                echo "<img height=120 width=120 src='imagens/" . $arquivo['name'] . "'>";  
                echo "<tr><td>Nome:</td><td><b>$nome</b></td></tr>";  
                echo "<tr><td>Endereço:</td><td><b>$ender</b></td></tr>";    
                echo "<tr><td>CPF:</td><td><b>$cpf</b></td></tr>"; 
                echo "<tr><td>Estado:</td><td><b>$estado</b></td></tr>";
                echo "<tr><td>Data de Nascimento:</td><td><b>$dtNasc</b></td></tr>";
                echo "<tr><td>Sexo:</td><td><b>$sexo</b></td></tr>";
                echo "<tr><td>Interesse:</td><td><b>$interesse</b></td></tr>";
                echo "<tr><td>Login:</td><td><b>$login</b></td></tr>";
                echo "<tr><td>Senha:</td><td><b>$senha1</b></td></tr>";

                echo "</b></td></tr></table>";
            } //Fim IF camposOK   
        ?>
    </body>
</html>
