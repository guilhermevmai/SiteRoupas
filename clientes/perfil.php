<?php
    session_start();
    require_once 'functions.php';
    
    ver($_GET['id']);
    $_SESSION['nome'] = $user['nome'];
?>

<?php
    include(HEADER_TEMPLATE);
?>

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

<h1>Perfil:</h1>

<form action="perfil.php?id=<?php echo $user['id'];?>" method="POST">
    <div class="row">
       
        <!-- Área onde fica os campos do formulário -->

        <div class="form-group col-md-7">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" name="user['nome']" value="<?php echo $user['nome'];?>" readonly>
        </div>
        <div class="form-group col-md-4">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="user['email']" value="<?php echo $user['email'];?>" readonly>
        </div>
    </div>
<?php
    if ($_SESSION['id'] == 1):

?>
    <div id="actions" class="row">
        <div class="col-md-12">
            <a href="edit.php?id=<?php echo $user['id']; ?>" class="btn btn-warning">Editar Nome</a>
            <a href="index.php" class="btn btn-success">Cancelar</a>
        </div>
    </div>
<?php else: ?>
    <div id="actions" class="row">
        <div class="col-md-12">
            <a href="edit.php?id=<?php echo $user['id']; ?>" class="btn btn-warning">Editar Nome</a>
             <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delemodal" data-user="<?php echo $_SESSION['id']; ?>">
            Excluir conta                        
            </a>
            <a href="index.php" class="btn btn-success">Cancelar</a>

        </div>
    </div>
<?php endif; ?>

</form>
<?php 
    include('../modais/modalContaDelete.php'); 
?>

<?php 
    include(FOOTER_TEMPLATE);
?>