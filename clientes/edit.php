<?php
    session_start();
    require_once('functions.php');

    edit();
    
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

<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $_SESSION['message']; ?>
    </div>

    <?php 
      clear_messages();
    ?>
<?php endif; ?>

<h2>Atualizar Perfil</h2>
<div class="container">
<form action="edit.php?id=<?php echo $user['id'];?>" method="POST" data-toggle="validator" role="form">
    <div class="row">
       
        <!-- Área onde fica os campos do formulário -->

        <div class="form-group col-md-7">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" name="user['nome']" value="<?php echo $user['nome'];?>" required>
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