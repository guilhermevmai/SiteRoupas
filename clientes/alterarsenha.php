<?php
    session_start();
    require_once('functions.php');
    trocaSenha();
    
?>

<?php
    include(HEADER_TEMPLATE);
?>

<?php if($user['id'] == 1 ):
?>

<?php 
    $_SESSION['message'] = '<strong>ERRO: USUÁRIO MASTER NÃO PODE SER MODIFICADO!!</strong>';
    $_SESSION['type'] = 'danger';
    header('Location: ../index.php');
?>
<?php else: ?>


    
<h2>Trocar Senha</h2>
<div class="container">
<form action="alterarsenha.php?id=<?php echo $user['id'];?>" method="POST" data-toggle="validator" role="form">
    <div class="row">
       
        <!-- Área onde fica os campos do formulário -->

        <div class="form-group col-md-7">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" name="user['nome']" value="<?php echo $user['nome'];?>" readonly required>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="user['email']" value="<?php echo $user['email'];?>" data-error="Insira um Email válido!" readonly required>
            <div class="help-block with-errors"></div>
        </div>        
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label for="senhaAntes">Senha Antiga:</label>
            
            <input type="password" class="form-control" name="senhaAntes" data-minlength="3" required>
        </div>        
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label for="senhaDepois">Nova Senha:</label>
            
            <input type="password" class="form-control" id="senhaDepois" name="senhaDepois" data-minlength="5" required>
        </div>
        <div class="form-group col-md-3">
            <label for="consenha">Confirmar Senha:</label>
            <input type="password" class="form-control" name="consenha" data-match="#senhaDepois" data-match-error="Atenção! As senhas devem ser iguais" required>
            <div class="help-block with-errors"></div>
        </div> 
    </div>
    <div id="actions" class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="perfil.php" class="btn btn-danger">Cancelar</a>

        </div>
    </div>
</form>
</div>
<?php endif; ?>
<?php 
    include(FOOTER_TEMPLATE);
?>