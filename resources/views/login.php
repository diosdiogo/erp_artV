
    <div class="login-box">

        <div class="login-box-body">
            <div class="login-logo">
                <img src="./public/assets/image/logo-mobi.png" alt="Mobi" height="80" width="160" />
            </div>

            <p class="login-box-msg">Faça login para começar a sua sessão</p>
            
            <form action="<?=$url?>/validalogin" role="form" method="POST">
               
                <div class="form-group has-feedback">
                    <input id="email" name="email" type="email" class="form-control" placeholder="Email" value="" />
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                
                                
                <div class="form-group has-feedback">
                    <input id="password" name="password" type="password" class="form-control" placeholder="Senha" />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                
                <span class="help-block">
                    <strong></strong>
                </span>
                
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                    </div>
                </div>
            </form>
            
            <!--<a href="#">Esqueci minha senha</a>-->

            <br />
        </div>

        <br>
       <?php if(isset($_SESSION['ERROR'])){
            
        ?>
            <div class="callout callout-<?=$_SESSION["TIPO_AVISO"]?>" style="margin-bottom: 0!important;">
                <h4> <?=$_SESSION['ERROR']?></h4>
            </div>
       <?php
       }
       ?>
            
       

    </div>

    <script src="./public/assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="./public/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="./public/assets/plugins/iCheck/icheck.min.js"></script>

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>

