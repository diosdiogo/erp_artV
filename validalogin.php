<?php 
    include_once('config.php');
    include_once("conn.php");

    $email = $_POST['email'];
    $pass = $_POST['password'];

   $user = $pdo->prepare("SELECT * FROM erp_cdl.user where email = :email and password = :pass ;");
   $user->bindValue(":email", $email);
   $user->bindValue(":pass", $pass);
    $user->execute();
    $result = $user->fetch(PDO::FETCH_ASSOC);
    $row = $user->rowCount();

    if ($row > 0) {
        $filiais = $pdo->prepare("SELECT * FROM erp_cdl.empresafilial where id = :idFilial;");
        $filiais->bindValue(":idFilial", $result['idempresafilial']);
        $filiais->execute();
        $resultfiliais = $filiais->fetchAll(PDO::FETCH_ASSOC);;

        $matriz =$pdo->prepare("SELECT * FROM erp_cdl.empresa where id = :idMatriz;");
        $matriz->bindValue(":idMatriz", $result['idmatriz']);
        $matriz->execute();
        $resultmatriz = $matriz->fetch(PDO::FETCH_ASSOC);

        if($resultmatriz['bloqueiofinanceiro'] == 0){

            if($result['deletado'] == 'N'){

                if (isset($_SESSION['ERROR'])) {
                    unset($_SESSION['ERROR']);
                }
                $_SESSION['matriz'] = $resultmatriz;
                $_SESSION['filiais'] = $resultfiliais;

                $_SESSION["user"] = $result['email'];
                $_SESSION["pass"] = $result['password'];
                $_SESSION['usuario'] = $result;
                header("Location:" .$url."/home");
            }else{
                $_SESSION["TIPO_AVISO"] = "danger";
                $_SESSION['ERROR'] = "USUÁRIO NÃO TEM PERMISSÃO ";
                header("Location:" .$url."/login");
            }
           
        }else{
            $_SESSION["TIPO_AVISO"] = "warning";
            $_SESSION['ERROR'] = "ENTRAR EM CONTATO COM FINANCEIRO";
            header("Location:" .$url."/login");
            
        }

        
    }else{
        $_SESSION["TIPO_AVISO"] = "danger";
        $_SESSION['ERROR'] = "USUÁRIO OU SENHA INCORRETO";
        header("Location:" .$url."/login");
    }

   