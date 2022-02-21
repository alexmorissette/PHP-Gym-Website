<?php

$itemsParPage = 4;
$total = isset($_SESSION['total']) ? $_SESSION['total'] : 0;

if(isset($_POST['ajout']) 
    && isset($_POST['productId']) 
    && isset($_POST['nom']) 
    && isset($_POST['description']) 
    && isset($_POST['image']) 
    && isset($_POST['prix']))
    {
        AjouterProduit($total);
        // Allez au cart
        header("Location:index.php?Page=Cart");
    }
    
    function AjouterProduit($totalCart){
        $item = array();
        //Mettre le produit sélectionné dans l'array
        $item = [$_POST['productId'],
        $_POST['nom'],
        $_POST['description'],
        $_POST['image'],
        $_POST['prix']];
        
        // Ajouter l'array du produit dans la variable Session['Cart] et conserver le nombre d'article dans Session['CartCount']
        $_SESSION['Cart'][] = $item;
        //Incrémentrer le badge du Cart dans le head menu.
        $_SESSION['CartCount'] = sizeof($_SESSION['Cart']);
        //Calculer le total du cart
        $totalCart += $_POST['prix'];
        $_SESSION['total'] = $totalCart;
    }

// Affichage
//Prepared statement
$statement = $cn->prepare("SELECT id, nom, prix, description, image FROM produits ORDER BY 1 desc");
$statement->execute(); 
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <h1 class="pb-4">Catalogue</h1>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            $cptItems = 0;
            //Boucle pour l'affichage des produits du catalogue
            foreach ($result as $row) { 
                ?>
                <form action='#' method='POST'>
                <input type='hidden' value='<?=$row['id']?>' name='productId' />
                    <div class='col mb-5'>
                        <div class='card h-100'>
                            <input type='hidden' value='<?=$row['image']?>' name='image' />
                            <img class='card-img-top mt-2' src='<?=$row['image']?>' alt='image item catalogue' />
                                <div class='card-body p-4'>
                                    <div class='text-center'>
                                        <input type='hidden' value='<?=$row['nom']?>' name='nom' />
                                        <h5 class='fw-bolder'><?=$row['nom']?></h5>
                                        <input type='hidden' value='<?=$row['prix']?>' name='prix' />
                                        <h6><?=$row['prix']?><span> $</span></h6>
                                    </div>
                                    <div class='text-center'>
                                        <input type='hidden' value='<?=$row['description']?>' name='description' />
                                        <p><?=$row['description']?></p>
                                    </div>
                                </div>
                            <!-- Product actions-->
                            <div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>
                                <div class='text-center'>
                                    <!-- <a href='#'> -->
                                        <button name='ajout' type='submit' class='btn btn-outline-dark mt-auto'>Ajouter au panier</button>
                                    <!-- </a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
           <?php
            } // Fin foreach
            echo "<div class='row'></div>"
            ?>

    </div>
</section>