<div class="row show-grid">
    <div class="col-lg-4">&nbsp;</div>
    <div class="col-lg-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"> Inicio de Sesión </h3>
            </div>
            <?php if ( $Login_ErrorMsg != 0) { ?>
            <?php if ( $Login_ErrorMsg != 3) { ?>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error!</strong> <?php echo $lbl_Login_ErrorMsg[$Login_ErrorMsg];?>
            </div>
            <?php }
                    else
                    {
                ?>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Listo!</strong> <?php echo $lbl_Login_ErrorMsg[$Login_ErrorMsg];?>
            </div>
                <?php
                    }
                ?>
            <?php } ?>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <input type='hidden' name='login_submitted' />
                    <input type='hidden' name='recovering_password' />
                    <div class="form-group">
                      <label for="InputEmail">Correo Electrónico:</label>
                      <input type="email" class="form-control" id="InputEmail" name="InputEmail" placeholder="Ingresa tu correo electrónico">
                    </div>
                    <button type="submit" class="btn btn-default">
                        Recuperar Contraseña
                    </button>
                </fieldset>
            </form>
        </div>
    </div>
    <div class="col-lg-4">&nbsp;</div>
</div>