<?php
    require 'SessionConn.php';

    if(isset($_GET['disconnect'])){
        session_destroy();
        header("Location:index.php");
    }
function phpAlert($msg) {
        echo '<script language="javascript">alert("' . $msg . '")</script>';
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>GetInShape.com</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="assets/css/styles.css" rel="stylesheet" />
        <!--Mon style-->
        <link href="assets/css/site.css" rel="stylesheet" />

    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php?Page=Catalogue">GetInShape</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php?Page=Catalogue">Boutique</a></li>
                        </ul>
                    <form action="index.php?Page=Cart" method="POST" class="d-flex">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                            <?php
                                if(!isset($_SESSION['Login'])){
                                echo "<li class='nav-item'><a class='nav-link' href='index.php?Page=Login'>Se connecter</a></li>";
                                echo "<li class='nav-item'><a class='nav-link' href='index.php?Page=Signup'>Créer un compte</a></li>";

                                }elseif(isset($_SESSION['Login'])){
                                    echo "<li class='nav-item'><a class='nav-link' href='index.php?Page=Account'>Mon compte</a></li>";
                                    echo "<li class='nav-item'><a class='nav-link' href='index.php?disconnect=true'>Déconnexion</a></li>";
                                }
                                if(isset($_SESSION['Login']) && $_SESSION['isAdmin'] == true){
                                    echo "<li class='nav-item'><a class='nav-link' href='admin/index.php'>Admin</a></li>";
                                }
                                
                                ?>
                        </ul>
                        <!-- <a href="index.php?Page=Cart"> -->
                            <button name="cart" class="btn btn-outline-dark" type="submit">
                                <i class="bi-cart-fill me-1"></i>
                                Panier
                                <span class="badge bg-dark text-white ms-1 rounded-pill">
                                    <?=$_SESSION['CartCount'] ?? 0?>
                                </span>
                            </button>
                        <!-- </a> -->
                        <small style="text-align: center; padding-left: 5px; color: green;">Bonjour! <br /><?=$_SESSION['Nom']??null?></small>
                        
                    </form>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="my-bg bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">GetInShape</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Tout pour vous mettre en forme!</p>
                </div>
            </div>
        </header>
        
        <!-- ********************** CONTENU DES PAGES ***********************-->
        <?php
            if(isset($_GET['Page'])){
                $page = $_GET['Page'];
                switch($page){
                    Case "Catalogue": include("includes/Catalogue.php");
                    break;
                    Case "Login": include("includes/Login.php");
                    break;
                    Case "Signup": include("includes/Signup.php");
                    break;
                    Case "Cart": include("includes/Cart.php");
                    break;
                    Case "Account": include("includes/Account.php");
                    break;
                    Default : include("includes/Catalogue.php");
                } 
            }else{
                include("includes/Catalogue.php");
            }
        ?>

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Tous droits réservés &copy; AMW 2021</p>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="assets/js/scripts.js"></script>
    </body>
</html>
