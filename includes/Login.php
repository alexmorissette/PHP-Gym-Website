<?php

	if(isset($_SESSION['Login'])){
		echo "<div><h3>Déjà authentifié...</h3></div>";
		echo "<div><a href='index.php?Page=Account'>Allez à Mon compte</a></div>";
		exit();
    }

    
    // var_dump($_POST['LogInBtn']);
    // var_dump($_POST['txtEmail']);
    // var_dump($_POST['txtPassword']);

    if (isset($_POST['LogInBtn']) && !empty($_POST['txtEmail']) && !empty($_POST['txtPassword'])) 
    {
        $Email = $_POST['txtEmail'];
        $Password = $_POST['txtPassword'];

        try {
            //Login Prepared statement
            $statement = $cn->prepare("SELECT * FROM utilisateurs WHERE Email LIKE '$Email'");
            $statement->execute(); //execute retourne un bool
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }

        // Capturer le premier résultat de la requête
        $UserInfo = $result[0] ?? null;

        // Assigner le password de la bd 
        $bdPassword = isset($UserInfo['Password']) ? $UserInfo['Password'] : null;

        if($UserInfo == null){
            echo "<div class='alert alert-warning'>Ce courriel n'existe pas dans notre système. Vérifiez la saisie ou créer un nouveau compte.</div>";
        }elseif($bdPassword == null) {
            echo "<div class='alert alert-danger'>Mot de passe invalide.</div>";
        }elseif($bdPassword == $Password){
            LogIn($UserInfo);
            if(isset($_SESSION['Cart'])){
                header("Location:index.php?Page=Cart");
            }else header("Location:index.php?Page=Account");
        }
    }

function LogIn($uInfo){
    $_SESSION['Login'] = true;
    if($uInfo['isAdmin'] == 1){
        $_SESSION['isAdmin'] = true;
    }else $_SESSION['isAdmin'] = false;
    // Assignation des champs à SESSION
    $_SESSION['UserId'] = $uInfo['UserId'];
    $_SESSION['Nom'] = $uInfo['Nom'];
    $_SESSION['Email'] = $uInfo['Email'];
    $_SESSION['Telephone'] = $uInfo['Telephone'];
}

?>

<section class="py-5 center">
    <div class="container px-4 px-lg-5 mt-5">
        <form method="POST" action="#" class="form-horizontal">
            <h2>Connectez-vous à votre compte</h2>
            <div class="form-group col-sm-10 mb-3">
                <input type="email" class="form-control" id="txtEmail" required value='' placeholder="Courriel" name="txtEmail" />
            </div>
            <div class="form-group col-sm-10 mb-3">
                <input type="password" class="form-control" id="txtPassword" required value='' placeholder="Mot de passe" name="txtPassword" />
            </div>              
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10 mb-3">       
                    <button class="btn btn-secondary" type="submit" name="LogInBtn">
                        Se Connecter
                    </button>
                </div>
                <div class="col-sm-offset-2 col-sm-10 mb-3">
                    <a href="index.php?Page=Signup">Créer un compte</a>
                </div>
            </div>
        </form>
    </div>
</section>