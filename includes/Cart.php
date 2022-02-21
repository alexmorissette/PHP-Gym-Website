<?php

$items = $_SESSION['Cart'] ?? null;
$_SESSION['Historique'] ?? null;
$_SESSION['commande'] ?? null;

// Au click du bouton Payer, si le user est login:
if(isset($_POST['Payer']) && isset($_SESSION['UserId'])){
    // S'il n'y a rien dans le cart, on reste sur la page cart
    if($_SESSION['CartCount'] == 0){
        header("Location:index.php?Page=Cart");
    }else{
        PayerCommande($items);
    }
    // Puis on va à Mon compte.
    header("Location:index.php?Page=Account");
    // Si le user n'est pas authentifié, on le redirige sur la page Login
}elseif(isset($_POST['Payer']) && !isset($_SESSION['Login'])){
    header("Location:index.php?Page=Login");
} 

// Pour vider le cart seulement
if(isset($_POST['clearCart']) && !empty($_SESSION['Cart'])){
    Viderpanier($items);
}

// FONCTIONs
function ViderPanier($items){
    $_SESSION['commande'] = $items;
    unset($items);
    unset($_SESSION['total']);
    unset($_SESSION['Cart']);
    $_SESSION['CartCount'] = 0;
}

function PayerCommande($items){
    // S'il y a des items dans le cart, on transfère l'array $items(cart) à commande
    // Puis transfère commande à l'historique (Mon compte...)
    // Puis on vide le cart...
    $_SESSION['commande'] = $items;
    $_SESSION['Historique'][] = $_SESSION['commande']; 
    unset($items);
    unset($_SESSION['Cart']);
    unset($_SESSION['total']);
    unset($_SESSION['CartCount']);

    phpAlert("Merci pour votre achat!");
}

?>
<section class="py-5">
    <div class="container container px-4 px-lg-5 mt-5">
        <h1 class="pb-4">Votre panier</h1>
        <div class="card">
            <div class="row">
                <div class="col-md-8 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col">
                                <h4><b>Vos articles</b></h4>
                            </div>
                        </div>
                    </div>
                    <?php
                    // Pour éviter les undefined
                    if(isset($items) && $items != null && sizeof($items) == $_SESSION['CartCount']){
                        foreach ($items as $item) 
                        { 
                            if($item != null){
                            //   0 => id
                            //   1 => nom
                            //   2 => description
                            //   3 => image path
                            //   4 => prix
                            ?>
                            <div class="row border-top border-bottom">
                                <div class="row main align-items-center">
                                    <input type="hidden" name="<?=$item[0]?>" />
                                    <div class="col-2"><img class="img-fluid" src="<?=$item[3]?>"></div>
                                        <div class="col">
                                            <div class="row text-muted"><?=$item[1]?></div>
                                            <div class="row small"><?=$item[2]?></div>
                                        </div>
                                    <div class="col">
                                        <?=$item[4]?>
                                        <span class="close"></span>
                                        &dollar;
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                        }
                    }
                    ?>
                    
                    <div class="back-to-shop">
                        <form action="#" method="POST">
                            <div>
                                <button name="clearCart" class="btn btn-secondary float-sm-end mb-3">Vider le panier</button>
                            </div>
                        </form>
                        <a href="index.php?Page=Catalogue" style="text-decoration: none;">
                            <button class="btn btn-secondary">&#x2190;</button>
                        </a>
                        <span class="text-muted">Retour au catalogue</span>

                    </div>
                        
                </div>
                <!-- Section de droite (sommaire) -->
                <div class="col-md-4 summary">
                    <div>
                        <h5><b>Sommaire</b></h5>
                    </div>
                    <hr>
                <div class="row">
                    <div class="col" style="padding-left:0;">Nombre d'articles : <?=$_SESSION['CartCount']??0?></div>
                </div>
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="col">PRIX TOTAL</div>
                    <div class="col text-right"><?=$_SESSION['total']??0?> &dollar;</div>
                </div>
                <form action="#" method="POST">
                    <button name="Payer" class="btn btn-outline-primary">Payer</button>
                </form>    
                </div>
            </div>
        </div>
    </div>
</section>