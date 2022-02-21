<?php
try {

    if(isset($_SESSION['Login'])){
        phpAlert("Déjà authentifié");
        header("Location:index.php?Page=Catalogue");
    }
    
    if(isset($_POST["SignUp"]) && isset($_POST["txtFullName"]) && isset($_POST["txtPhone"]) && isset($_POST["txtEmail"]) && isset($_POST["txtPassword"])){
        
        if (isValidForm()){
            // INSERT
            $query = "INSERT INTO utilisateurs (Password, Email, Nom, Telephone) VALUES ";
            $query .= "('" . $_POST["txtPassword"] . "', '" . $_POST["txtEmail"] . "', '" . $_POST["txtFullName"] . "', '" . $_POST["txtPhone"] . "')";
            $cn->exec($query);   

            if($cn == true){
                // Message de bienvenue
                phpAlert("Votre compte a été créé avec succès! Vous allez être redirigé vers la page de votre compte. Veuillez vous connecter pour accéder à votre compte.");
                // Redirection
                header("Location:index.php?Page=Login");
            }else phpAlert("Erreur");
    
        }else{
            // Erreur
            echo "<div class='alert alert-danger'>Formulaire invalide</div>";
        }
    }
    
} catch (PDOException $ex) {
    echo $ex->getMessage();
}

function isValidForm(){
    $valid = true;
    
    $nom = $_POST["txtFullName"];
    $tel = $_POST["txtPhone"];
    $email = $_POST["txtEmail"];
    $pass = $_POST["txtPassword"];

    // NOM
    if(preg_match("#^([a-z A-Z\-.',])+$#", $nom) === 0){
        $valid = false; 
        echo "<div class='alert alert-danger'>Le formulaire n'accepte pas le nom tel qu'inscrit...Utilisez des lettres, des espaces ou ces caractères: (- . ' ,)</div>";
    }
    //EMAIL
    if(preg_match("#^.+@\w+(\.\w+)+$#i", $email) === 0){
        $valid = false; 
        echo "<div class='alert alert-danger'>\"$email\" n'est pas un email valide.</div>";
    }
    // TELEPHONE
    if(preg_match('#^(\(\d{3}\) )?\d{3}-\d{4}$#', $tel) === 0){
        $valid = false;
        echo "<div class='alert alert-danger'>\"$tel\" est invalide pour le champ téléphone.</div>";
    }
    //PASSWORD
    if(preg_match('#.#', $pass) === 0){
        $valid = false;
        echo "<div class='alert alert-danger'>Le mot de passe doit avoir entre 8 et 16 caractères.</div>";
    }

    return $valid;
}
?>


<section class="py-3">
    <div class="container container px-4 px-lg-5 mt-3">
        <form method="POST" action="#" class="form-horizontal">
            <div class="marginAll">
                <h2 class="mb-2">Créez votre compte</h2>
                    <!-- NOM -->
                    <div class="form-group col-sm-10 my-3">
                        <input type="text" 
                        class="form-control" 
                        required 
                        value=""
                        name="txtFullName" 
                        id="txtFullName" 
                        placeholder="Nom complet" />
                    </div>
                    <!-- TELEPHONE -->
                    <div class="form-group col-sm-10 mb-3">
                        <input type="text" 
                        class="form-control mb-0" 
                        name="txtPhone"
                        value="" 
                        id="txtPhone" 
                        required
                        placeholder="Téléphone" />
                        <small style='font-size:0.7rem;'><em>(123) 456-7890</em></small>
                    </div>
                    <!-- EMAIL -->
                    <div class="form-group col-sm-10 mb-3">
                        <input 
                        type="text" 
                        required
                        value=""
                        class="form-control" 
                        name="txtEmail" 
                        id="txtEmail" 
                        placeholder="email@domain.com" />
                    </div>
                    <!-- MOT DE PASSE -->
                    <div class="form-group col-sm-10 mb-3">
                        <input type="password" 
                        class="form-control" 
                        id="txtPassword" 
                        required
                        value=""
                        placeholder="Mot de passe" 
                        name="txtPassword" />       
                    </div>
                    <!-- SIGNIN-->
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10 mb-3">
                            <button class="btn btn-secondary" type="submit" name="SignUp">
                                Enregistrer
                            </button>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10 mb-3">
                            <a href="index.php?Page=Login">Connectez-vous</a>
                            ... si vous avez déjà un compte.
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>