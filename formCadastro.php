<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <!-- HTML5 -->
        <meta charset="utf-8"/>  
        <title>Cadastro de Cliente</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form method="post" name="formCadastro"    
            action="http://localhost/cadastros/cadclientedb.php" 
            enctype="multipart/form-data">  
            <h1>Cadastro de Cliente</h1>
            <table width="100%"> 
                <tr>
                    <th>Foto</th>
                    <td><INPUT type="file" name="txtFoto"><td>
                </tr>

                <tr>
                    <th width="18%">Nome</th>
                    <td width="82%"><input type="text" name="txtNome"></td>
                </tr>
                <tr>
                    <th>CPF</th>
                    <td><input type="text" name="txtCPF" maxlength="14"></td>
                </tr>
                <tr>
                    <th>Endereço</th>
                    <td>
                        <textarea name="txtEndereco" cols="30" rows="4"></textarea>
                    </td>
                </tr>  
                <tr>  
                    <th>Estado</th>
                    <td>
                        <select name="listEstados">
                            <option value="BA">Bahia</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="SP">São Paulo</option>
                        </select>
                    </td>    
                </tr>
                <tr>
                    <th>Data Nasc.</th>
                    <td><input type="date" name="textDataNascimento"></td>
                </tr>
               <tr>
                    <th>Sexo</th>
                    <td>  
                        <select name=listSexo>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                        </select>    
                    </td>
                </tr>

                <tr>
                    <th>login</th>
                    <td><input type="text" name="txtLogin"></td>    
                </tr>
                <tr>
                    <th>Senha</th>
                    <td><input type="password" name="txtSenha"></td>    
                </tr>
                <tr>
                    <th>Confirma Senha</th>
                    <td><input type="password" name="txtConfirmaSenha"></td>    
                </tr>
                <tr>
                
                    <td colspan=2 >
                        <input type="submit" name="btnEnviar" value="Enviar">
                        <input type="reset" name="btnLimpar" value="Limpar">
                    </td>
                </tr>
            </table>
        </form>    
    </body>
</html>