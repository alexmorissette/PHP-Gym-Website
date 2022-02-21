<?php    
require '../SessionConn.php';

if(isset($_SESSION['isAdmin']) == false){
    echo "Vous n'êtes pas autorisé à cette partie du site.";
    exit();
}

if(isset($_GET['disconnect'])){
    session_destroy();
    header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin - GetInShape.com</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../assets/css/styles.css" rel="stylesheet" />
        <!--Mon style-->
        <link href="../assets/css/site.css" rel="stylesheet" />

    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="../index.php?Page=Catalogue">GetInShape</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form class="d-flex">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                            <?php
                                if(isset($_SESSION['isAdmin'])){
                                    echo "<li class='nav-item'><a class='nav-link' href='../index.php?disconnect=true'>Deconnexion</a></li>";
                                    echo "<li class='nav-item'><a class='nav-link' href='index.php?Page=CatalogueAdmin'>Produits et services</a></li>";
                                    echo "<li class='nav-item'><a class='nav-link' href='index.php?Page=Utilisateurs'>Utilisateurs</a></li>";
                                }
                            ?>
                    </form>
                </div>
            </div>
        </nav>
        
        <div class="m-4"><em style="float: right;">Bienvenue, <?=$_SESSION['Nom']?></em></div>
        
        <!-- ********************** CONTENU DES PAGES ***********************-->
        <?php
            if(isset($_GET['Page'])){
                $page = $_GET['Page'];
                switch($page){
                    Case "Ajout": include("includes/Ajout.php");
                    break;
                    Case "Edit": include("includes/Edit.php");
                    break;
                    Case "Utilisateurs": include("includes/Utilisateurs.php");
                    break;
                    Case "CatalogueAdmin": include("includes/CatalogueAdmin.php");
                    break;
                    Default : include("includes/CatalogueAdmin.php");
                } 
            }else{
                include("includes/CatalogueAdmin.php");
            }
        ?>

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Tous droits réservés &copy; AMW 2021</p>
                <!-- <p class="m-0 text-center text-white"><a href="index.php?Page=CatalogueAdmin">Administration</a></p> -->
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../assets/js/scripts.js"></script>
    </body>
</html>


    
    