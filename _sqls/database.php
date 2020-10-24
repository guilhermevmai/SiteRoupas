<?php
 require_once '../config.php'; 
 require_once DBAPI;
mysqli_report(MYSQLI_REPORT_STRICT);

function open_database(){
    	try{
    		$cone = new mysqli(HOST, USER, SENHA, DB);
    		return $cone;
    	}catch (Exception $e){
    		echo $e->getMessage();
    		return null;
    	}
    }

    function close_database($conn) {		
    	try {				
    		mysqli_close($conn);			
    	} catch (Exception $e) {				
    		echo $e->getMessage();			
    	}		
    }

    

    
?>

<?php
    function clear_messages(){
       unset($_SESSION['message']);
       unset($_SESSION['type']);
    }
?>

<?php

	function find_users($table = null, $id = null){
		$database = open_database();		
		$found = null;

		try{
			if($id){
				$sql = "SELECT * FROM " . $table . " WHERE id = " . $id;		    
				$result = $database->query($sql);
				
				if($result->num_rows > 0){
					$found = $result->fetch_assoc();
				}
			}else{
				$sql = "SELECT * FROM " . $table . " WHERE nivel > 1 AND nivel < 4 order by nome";
				$result = $database->query($sql);
				
				if($result->num_rows > 0){
					$found = $result->fetch_all(MYSQLI_ASSOC);
				}
			}
		}catch(Exception $e){
			$_SESSION['message'] = $e->getMessage();
			$_SESSION['type'] = 'danger';
		}
		close_database($database);
		return $found;
	}
?>

<?php

	function find_all_func($table){
		return find_users($table);
	}
?>

<?php

    function find_func($table = null, $id = null){
        $database = open_database();        
        $found = null;

        try{
            if($id){
                $sql = "SELECT * FROM " . $table . " WHERE id = " . $id;            
                $result = $database->query($sql);
                
                if($result->num_rows > 0){
                    $found = $result->fetch_assoc();
                }
            }else{
                $sql = "SELECT * FROM " . $table . " WHERE nivel = 2 order by nome";
                $result = $database->query($sql);
                
                if($result->num_rows > 0){
                    $found = $result->fetch_all(MYSQLI_ASSOC);
                }
            }
        }catch(Exception $e){
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger';
        }
        close_database($database);
        return $found;
    }
?>

<?php

    function find_all_users($table){
        return find_users($table);
    }
?>

<?php
	function find($table = null, $id = null){
		$database = open_database();		
		$found = null;

		try{
			if($id){
				$sql = "SELECT * FROM " . $table . " WHERE id = " . $id;		    
				$result = $database->query($sql);
				
				if($result->num_rows > 0){
					$found = $result->fetch_assoc();
				}
			}else{
				$sql = "SELECT * FROM " . $table . " ORDER BY nome";
				$result = $database->query($sql);
				
				if($result->num_rows > 0){
					$found = $result->fetch_all(MYSQLI_ASSOC);
				}
			}
		}catch(Exception $e){
			$_SESSION['message'] = $e->getMessage();
			$_SESSION['type'] = 'danger';
		}
		close_database($database);
		return $found;
	}
?>

<?php

function find_all($table){
	return find($table);
}
?>

<?php
    function find_prods($table = null, $id = null){
        $database = open_database();        
        $found = null;

        try{
            if($id){
                $sql = "SELECT * FROM " . $table . " WHERE id = " . $id;            
                $result = $database->query($sql);
                
                if($result->num_rows > 0){
                    $found = $result->fetch_assoc();
                }
            }else{
                $sql = "SELECT p.id as id,p.nome as nome, p.descricao as descricao, p.preco as preco, c.nome as categoria, c.id as idCat FROM $table as p
                left join categoria as c on(p.idCat = c.id) order by p.nome";
                $result = $database->query($sql);
                
                if($result->num_rows > 0){
                    $found = $result->fetch_all(MYSQLI_ASSOC);
                }
            }
        }catch(Exception $e){
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger';
        }
        close_database($database);
        return $found;
    }
?>

<?php

function find_all_prods($table){
    return find_prods($table);
}
?>

<?php
    function find_prods_last($table = null,$cat = null ,$id = null){
        $database = open_database();        
        $found = null;

        try{
            if($id){
                $sql = "SELECT * FROM " . $table . " WHERE id = " . $id;            
                $result = $database->query($sql);
                
                if($result->num_rows > 0){
                    $found = $result->fetch_assoc();
                }
            }else{
                if($cat){
                    $sql = "SELECT p.id as id, p.nome as nome, p.descricao as descricao, p.preco as preco, c.nome as categoria, c.id as idCat FROM produto as p inner join categoria as c on(p.idCat = $cat) order by p.nome";

                }
                $sql = "SELECT p.id as id,p.nome as nome, p.descricao as descricao, p.preco as preco, c.nome as categoria, c.id as idCat FROM $table as p left join categoria as c on(p.idCat = c.id) order by p.nome";
                $result = $database->query($sql);
                
                if($result->num_rows > 0){
                    $found = $result->fetch_all(MYSQLI_ASSOC);
                }
            }
        }catch(Exception $e){
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger';
        }
        close_database($database);
        return $found;
    }
?>

<?php

function find_last_prods($table){
    return find_prods_last($table);
}
?>

<?php
    function find_prods10($table = null, $id = null){
        $database = open_database();        
        $found = null;

        try{
            if($id){
                $sql = "SELECT * FROM " . $table . " WHERE id = " . $id;            
                $result = $database->query($sql);
                
                if($result->num_rows > 0){
                    $found = $result->fetch_assoc();
                }
            }else{
                $sql = "SELECT p.id as id,p.nome as nome, p.descricao as descricao, p.preco as preco, c.nome as categoria, c.id as idCat FROM $table as p
                left join categoria as c on(p.idCat = c.id) order by p.id desc limit 10";
                $result = $database->query($sql);
                
                if($result->num_rows > 0){
                    $found = $result->fetch_all(MYSQLI_ASSOC);
                }
            }
        }catch(Exception $e){
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger';
        }
        close_database($database);
        return $found;
    }
?>

<?php

function find_last_prods10($table){
    return find_prods10($table);
}
?>


<?php
	
	function save($table = null, $data = null){
		$database = open_database();

		$columns = null;
		$values = null;

		
		foreach ($data as $key => $value) {
			$columns .= trim($key, "'") . ",";
			$values .= "'$value',";
			
		}

		//remove a virgula no final

		$columns = rtrim($columns, ",");
		$values = rtrim($values, ",");


			$sql = "INSERT INTO " . $table . " ($columns) " . " VALUES " . "($values);";

		try{
			
			$database->query($sql);
			

			$_SESSION['message'] = 'Registro cadastrado com sucesso.';
			$_SESSION['type'] = 'success';

			
		}catch(Exception $e){

			$_SESSION['message'] = 'Não foi possível realizar a operação.';
			$_SESSION['type'] = 'danger';
		}

		close_database($database);
		
	}
?>

<?php
    
    function save2($table = null, $data = null, $senha = null){
        $database = open_database();

        $columns = null;
        $values = null;
        #$senha1 = md5($senha);

        
        foreach ($data as $key => $value) {
            $columns .= trim($key, "'") . ",";
            $values .= "'$value',";
            
        }

        //remove a virgula no final

        $columns = rtrim($columns, ",");
        $values = rtrim($values, ",");


        $sql = "INSERT INTO " . $table . " ($columns, senha) " . " VALUES " . "($values, md5('$senha'));";

        
        try{
            
            $insert = $database->query($sql);
            
            if ($insert) {
                $_SESSION['message'] = 'Registro cadastrado com sucesso.';
                $_SESSION['type'] = 'success';
                #header('Location: index.php');

            }else{
                $_SESSION['message'] = 'Erro ao cadastrar, tente novamente.';
                $_SESSION['type'] = 'danger';
                #header('Location: index.php');

            }
            
            
            
        }catch(Exception $e){

            $_SESSION['message'] = 'Não foi possível realizar a operação.';
            $_SESSION['type'] = 'danger';

        }

        close_database($database);
        
    }
?>

<?php
    
    function save4($table = null, $data = null, $senha = null){
        $database = open_database();

        $columns = null;
        $values = null;
        #$senha1 = md5($senha);

        
        foreach ($data as $key => $value) {
            $columns .= trim($key, "'") . ",";
            $values .= "'$value',";
            
        }

        //remove a virgula no final

        $columns = rtrim($columns, ",");
        $values = rtrim($values, ",");


        $sql = "INSERT INTO " . $table . " ($columns, senha, nivel) " . " VALUES " . "($values, md5('$senha'), 2);";

        
        try{
            
            $insert = $database->query($sql);
            
            if ($insert) {
                $_SESSION['message'] = 'Registro cadastrado com sucesso.';
                $_SESSION['type'] = 'success';
                #header('Location: index.php');

            }else{
                $_SESSION['message'] = 'Erro ao cadastrar, tente novamente.';
                $_SESSION['type'] = 'danger';
                #header('Location: index.php');

            }
            
            
            
        }catch(Exception $e){

            $_SESSION['message'] = 'Não foi possível realizar a operação.';
            $_SESSION['type'] = 'danger';

        }

        close_database($database);
        
    }
?>

<?php
    
    function save3($table = null, $data = null, $preco = null, $ind = null, $cat = null){
        $database = open_database();

        $columns = null;
        $values = null;
        #$senha1 = md5($senha);

        
        foreach ($data as $key => $value) {
            $columns .= trim($key, "'") . ",";
            $values .= "'$value',";
            
        }

        //remove a virgula no final

        $columns = rtrim($columns, ",");
        $values = rtrim($values, ",");


        $sql = "INSERT INTO " . $table . " ($columns, preco, identificacao, idCat) " . " VALUES " . "($values, $preco, $ind, $cat);";

        
        try{
            
            $insert = $database->query($sql);
            
            if ($insert) {
                $_SESSION['message'] = 'Cadastrado com sucesso.';
                $_SESSION['type'] = 'success';
                #header('Location: index.php');

            }else{
                $_SESSION['message'] = 'Erro durante o cadastro, tente novamente.';
                $_SESSION['type'] = 'danger';
                
                #header('Location: index.php');

            }
            
            
        }catch(Exception $e){

            $_SESSION['message'] = 'Não foi possível realizar a operação.';
            $_SESSION['type'] = 'danger';

        }

        close_database($database);
        
    }
?>

<?php

    function update($table = null, $id = 0, $data = null){

        $database = open_database();
        $itens =  null;

        foreach ($data as $key => $value) {
            $itens .= trim($key, "'") . "='$value',";
        }

        $itens = rtrim($itens, ',');

        $sql = "UPDATE " . $table;
        $sql .= " SET $itens";
        $sql .= " WHERE id=" . $id;

        try{
            $up= $database->query($sql);

            if ($up) {
                $_SESSION['message'] = 'Registro atualizado com sucesso.';
                $_SESSION['type'] = 'success';
            }else{
                $_SESSION['message'] = 'Erro ao atualizar o registro, tente novamente.';
                $_SESSION['type'] = 'danger';
            }
        }catch(Exception $e){
            $_SESSION['message'] = 'Não foi possível realizar a operação.';
            $_SESSION['type'] = 'danger';
        }
        close_database($database);
    }
?>

<?php

    function alterarPerfil($table = null, $id = 0, $data = null, $senha = null){

        $database = open_database();
        $itens =  null;

        if($id == 1){
            $_SESSION['message'] = '<strong>ERRO: USUÁRIO MASTER NÃO PODE SER MODIFICADO!!</strong>';
            $_SESSION['type'] = 'danger';
            header('Location: index.php');
        }else{
        foreach ($data as $key => $value) {
            $itens .= trim($key, "'") . "='$value',";
        }

        $itens .= rtrim($itens, ',');

       if ($senha == 0) {
            $sql = "UPDATE " . $table;
            $sql .= " SET $itens";
            $sql .= " WHERE id=" . $id;
       }else{
        $sql = "UPDATE " . $table;
        $sql .= " SET $itens, senha = md5('$senha')";
        $sql .= " WHERE id=" . $id;

    }
        try{
            $up= $database->query($sql);

            
            if ($up) {
                $_SESSION['message'] = 'Registro atualizado com sucesso.';
                $_SESSION['type'] = 'success';
                $sql2 = "SELECT nome FROM usuario WHERE id= $id";
                $select = $database->query($sql2);
                $result = $select->fetch_assoc();
                if ($result) {
                    $_SESSION['nome'] = $result;
                   
                }
            }else{
                $_SESSION['message'] = 'Erro ao atualizar o registro, tente novamente.';
                $_SESSION['type'] = 'danger';
            }
        }catch(Exception $e){
            $_SESSION['message'] = 'Não foi possível realizar a operação.';
            $_SESSION['type'] = 'danger';
        }
        }
        close_database($database);
    }
?>

<?php

    function alterarSenha($table = null, $id = 0, $senhaAntes = null, $senhaNova = null){

        $database = open_database();
        $itens =  null;

        if($id == 1){
            $_SESSION['message'] = '<strong>ERRO: USUÁRIO MASTER NÃO PODE SER MODIFICADO!!</strong>';
            $_SESSION['type'] = 'danger';
            header('Location: ../index.php');
        }else{


      
        $sql = "UPDATE " . $table;
        $sql .= " SET senha = md5('$senhaNova')";
        $sql .= " WHERE id= $id AND senha=md5('$senhaAntes')";

        try{
            $up= $database->query($sql);

            
            if ($up == true) {
                $_SESSION['message'] = 'Senha alterada com sucesso.';
                $_SESSION['type'] = 'success';
            }else{
                $_SESSION['message'] = 'Erro ao alterar senha, tente novamente.';
                $_SESSION['type'] = 'danger';
            }
        }catch(Exception $e){
            $_SESSION['message'] = 'Não foi possível realizar a operação.';
            $_SESSION['type'] = 'danger';
        }
        }
        close_database($database);
    }
?>

<?php

    function update2($table = null, $id = 0, $data = null, $senha = null){

        $database = open_database();
        $itens =  null;
        if($id == 1){
            $_SESSION['message'] = '<strong>ERRO: USUÁRIO MASTER NÃO PODE SER MODIFICADO!!</strong>';
            $_SESSION['type'] = 'danger';
            header('Location: index.php');
        }else{
        foreach ($data as $key => $value) {
            $itens .= trim($key, "'") . "='$value',";
        }

        $itens .= rtrim($itens, ',');

       if ($senha == 0) {
            $sql = "UPDATE " . $table;
            $sql .= " SET $itens";
            $sql .= " WHERE id=" . $id;
       }else{
        $sql = "UPDATE " . $table;
        $sql .= " SET $itens, senha = md5('$senha')";
        $sql .= " WHERE id=" . $id;

    }
        try{
            $up= $database->query($sql);

            
            if ($up) {
                $_SESSION['message'] = 'Registro atualizado com sucesso.';
                $_SESSION['type'] = 'success';

            }else{
                $_SESSION['message'] = 'Erro ao atualizar o registro, tente novamente.';
                $_SESSION['type'] = 'danger';
            }
        }catch(Exception $e){
            $_SESSION['message'] = 'Não foi possível realizar a operação.';
            $_SESSION['type'] = 'danger';
        }
        }
        close_database($database);
    }
?>

<?php

    function update3($table = null, $id = 0, $data = null, $preco = null , $identificacao = null, $cat = null){

        $database = open_database();
        $itens =  null;

        foreach ($data as $key => $value) {
            $itens .= trim($key, "'") . "='$value',";
        }

        $itens .= rtrim($itens, ',');

       
        $sql = "UPDATE " . $table;
        $sql .= " SET $itens, preco= $preco, identificacao= $identificacao, idCat = $cat";
        $sql .= " WHERE id=" . $id;


        try{
            $up= $database->query($sql);

            
            if ($up) {
                $_SESSION['message'] = 'Registro atualizado com sucesso.';
                $_SESSION['type'] = 'success';

            }else{
                $_SESSION['message'] = 'Erro ao atualizar o registro, tente novamente.';
                $_SESSION['type'] = 'danger';
            }
        }catch(Exception $e){
            $_SESSION['message'] = 'Não foi possível realizar a operação.';
            $_SESSION['type'] = 'danger';
        }
        
        close_database($database);
    }
?>

<?php

    function remove($table = null, $id = 0){

        $database = open_database();

        try{
            if ($id) {
                $sql = "DELETE FROM " . $table . " WHERE id=" . $id;
                $del = $database->query($sql);

                if ($del) {
                    $_SESSION['message'] = 'Registro excluído com sucesso.';
                    $_SESSION['type'] = 'success';


                }else{
                    $_SESSION['message'] = 'Erro ao excluir o registro, tente novamente.';
                    $_SESSION['type'] = 'danger';

                    
                }
            }
        }catch(Exception $e){
            $_SESSION['message'] = 'Não foi possível realizar a operação.';
            $_SESSION['type'] = 'danger';
            ;
        }

        close_database($database);
    }
?>

<?php

    function remove2($table = null, $id = 0){

        $database = open_database();

        try{
            if ($id) {
                $sql1 = "DELETE FROM listaDesejo WHERE idUser=" . $id;
                $database->query($sql1);

                $sql2 = "DELETE FROM " . $table . " WHERE id=" . $id;
                $del = $database->query($sql2);

                if ($del) {
                    $_SESSION['message'] = 'Registro excluído com sucesso.';
                    $_SESSION['type'] = 'success';


                }else{
                    $_SESSION['message'] = 'Erro ao excluir o registro, tente novamente.';
                    $_SESSION['type'] = 'danger';

                    
                }
            }
        }catch(Exception $e){
            $_SESSION['message'] = 'Não foi possível realizar a operação.';
            $_SESSION['type'] = 'danger';
            ;
        }

        close_database($database);
    }
?>

<?php 
/*require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';


    function emailRecuperacao($table = null, $email = null){
        $database = open_database();
        $email = $email;
        try{
            
                $sql1 = "SELECT * FROM " . $table . " WHERE email= '$email' ";
                $select = $database->query($sql1);
                if ($select->num_rows == 1) {
                    $chave = sha1(uniqid(mt_rand(), true));
                    $sql2 = "INSERT INTO recuperar(utilizador, confirmacao) VALUES('$email', '$chave')";
                    $insert = $database->query($sql2);
                    #$insertAfetado = $insert->affected_rows();
                    #if ($insert->affected_rows) {
                        $link = "localhost/ProjetoSiteRoupas/logs/recuperar.php?utilizador=$email&confirmacao=$chave";
                        //inicia a classe

                        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

                        //metodo de envio

                        $mail->isSMTP();
                        
                        //envia por SMTP

                        $mail->Host = "smtp.gmail.com";

                        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;

                        // Você pode alterar este parametro para o endereço de SMTP do seu provedor

                        $mail->Port = 587;

                        // Usar autenticação SMTP (obrigatório)

                        $mail->STMPAuth = true;

                        // Usuário do servidor SMTP (endereço de email)
                        

                        $mail->Username = 'guiphpmailer@gmail.com';
                        $mail->Password = 'phpmailer123';

                        // Configurações de compatibilidade para autenticação em TLS 

                    

                        // Você pode habilitar esta opção caso tenha problemas. Assim pode identificar mensagens de erro. 

                         #$mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;

                         // Define o remetente
                         // Seu e-mail 

                         $mail->setFrom('guiphpmailer@gmail.com', 'Loraflora');

                         //Destinatario

                         $mail->addAdress('$email');

                         // Definir se o e-mail é em formato HTML ou texto plano 

                         $mail->isHTML(false);

                         // Charset (opcional) 

                         $mail->CharSet = 'UTF-8';

                         // Assunto da mensagem 

                         $mail->Subject = "Recuperação de senha";

                         // Corpo do email 

                         $mail->Body = 'Olá' . $select['nome'] . ', você solicitou a recuperação da sua senha no site Lora Flora então acesse o link ' . $link; 

                         // Envia o e-mail

                         $enviado = $mail->send();

                         //Verificar se enviou

                         if ($enviado) {
                             $_SESSION['message'] = 'Email enviado com sucesso, aguarde alguns minutos.';
                             $_SESSION['type'] = 'success';
                             

                         }else{
                            $_SESSION['message'] = 'Erro ao enviar email';
                            $_SESSION['type'] = 'danger';
                            echo "string2";

                         }
                    #}else{
                        $_SESSION['message'] = 'Erro ao gerar email de verificação.';
                        $_SESSION['type'] = 'danger';
                        
                    #}
                }else{
                    $_SESSION['message'] = 'Email <strong>INEXISTENTE</strong> em nosso banco, verifique se foi digitado corretamente.';
                    $_SESSION['type'] = 'danger';
                    
                    
                }

            
            
        }catch(Exception $e){
            $_SESSION['message'] = 'Não foi possível realizar a operação.';
            $_SESSION['type'] = 'danger';
                      
        }
        close_database($database);
    }*/
?>

<?php
    
    function listas($idUser = null){
        $database = open_database();
        
        try{
            if ($idUser) {
                    $sql = "SELECT l.id as id, p.id as idProd, p.nome as nome, p.descricao as descricao, p.preco as preco FROM listaDesejo AS l, produto AS p WHERE l.idUser = $idUser AND l.idProd = p.id order by p.nome";
                    $result = $database->query($sql);
                
                    if($result->num_rows > 0){
                        $found = $result->fetch_all(MYSQLI_ASSOC);
                    }


            }
        }catch(Exception $e){
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger';  
        }

        close_database($database);
        return $found;
    }
?>

<?php
    
    function verificalistas($idUser = null){
        $database = open_database();
        
        try{
            if ($idUser) {
                    $sql = "SELECT l.idProd, l.idUser, p.id as id, p.nome as nome, p.descricao as descricao, p.preco as preco, c.nome as categoria from listaDesejo as l
                     right join produto as p on p.id = l.idProd and 8 = l.idUser 
                     left join categoria as c on p.idCat = c.id order by p.nome;";
                    $result = $database->query($sql);
                
                    if($result->num_rows > 0){
                        $found = $result->fetch_all(MYSQLI_ASSOC);
                    }


            }
        }catch(Exception $e){
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger';  
        }

        close_database($database);
        return $found;
    }
?>

<?php
    
    function addLista($idUser = null, $idProd = null){
        $database = open_database();

        try{
            if ($idUser) {
                if ($idProd) {
                    $sql = "INSERT INTO listaDesejo(idUser, idProd) VALUES($idUser, $idProd)";
                    $insert = $database->query($sql);
                    if ($insert) {

                    }else{
                        $_SESSION['message'] = 'Erro ao adicionar a lista de desejos.';
                        $_SESSION['type'] = 'danger';
                    }
                }else{
                $_SESSION['message'] = 'Produto inválido.';
                $_SESSION['type'] = 'danger';
                }
            }else{
                $_SESSION['message'] = 'Ocorreu um erro, tente novamente mais tarde.';
                $_SESSION['type'] = 'warning';
            }
        }catch(Exception $e){
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger';            
        }

        close_database($database);

    }
?>

<?php
    
    function delLista($idUser = null, $idProd = null){
        $database = open_database();

        try{
            if ($idUser) {
                if ($idProd) {
                    $sql = "DELETE from listaDesejo where idUser = $idUser and idProd = $idProd";
                    $insert = $database->query($sql);
                    
                    if ($insert) {

                    }else{
                        $_SESSION['message'] = 'Erro ao excluir da lista de desejos.';
                        $_SESSION['type'] = 'danger';
                    }
                }else{
                $_SESSION['message'] = 'Produto inválido.';
                $_SESSION['type'] = 'danger';
                }
            }else{
                $_SESSION['message'] = 'Ocorreu um erro, tente novamente mais tarde.';
                $_SESSION['type'] = 'warning';
            }
        }catch(Exception $e){
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger';            
        }

        close_database($database);

    }
?>