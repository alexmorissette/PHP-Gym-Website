<section class="py-5">
    <div class="container container px-4 px-lg-5 mt-5">
        <?php
           
            $history = $_SESSION['Historique'] ?? null;

            if(isset($_SESSION['Login']) && isset($_SESSION['UserId'])){

                echo "<h2>Mon compte</h2>";
                
                echo "<div class='m-3'><h3>Mes informations</h3>";
                echo "<input type='hidden' value='" . $_SESSION['UserId'] . "' name='id' />";
                echo "<div class='my-2'>Nom: " . $_SESSION['Nom'] . "</div>";
                echo "<div class='my-2'>Email: " . $_SESSION['Email'] . "</div>";
                echo "<div class='my-2'>Téléphone: " . $_SESSION['Telephone'] . "</div>";
                echo "</div>";
                echo "<hr />";

                // Section achats - historique
                echo "<div class='m-3'><h3>Mon historique d'achats</h3>";
                
                echo '<div id="accordion" class="mt-5">';

                if(isset($history)){
                    $histCount = 0;
                    // Afficher toutes les commandes achetées.
                    foreach($history as $commande){
                        $histCount++;
                        ?>
                            <div class="card mb-3">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        Commande #<?=$histCount?>
                                    </h5>
                                </div>
                                <div>
                                    <div class="card-body">
                                        <div class="row text-decoration-underline">
                                            <div class="col p-2 m-2">PRODUIT</div>
                                            <div class="col p-2 m-2">DESCRIPTION</div>
                                            <div class="col p-2 m-2">IMAGE</div>
                                            <div class="col p-2 m-2">PRIX</div>
                                        </div>
                                        <?php
                                        $total=0;
                                        foreach($commande as $item){ 
                                            ?>
                                            <div class="row p-3">
                                                <div class="col p-1 m-1"><?=$item[1]?></div>
                                                <div class="col p-1 m-1"><?=$item[2]?></div>
                                                <div class="col p-1 m-1 text-center"><img src="<?=$item[3]?>" width="100px" /></div>
                                                <div class="col p-1 m-1 text-center"><?=$item[4]?> $</div>
                                                <input type="hidden" value="<?php $total += $item[4]; ?>" />
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-9 p-2 m-2" style="text-align: right;">Total:</div>
                                            <div class="col-2 p-2 m-2 text-center"><?=$total?> $</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  <!-- //End Accordion -->
                    <?php
                    } // end foreach

                }else echo "Aucun achat effectué. S'il y a des articles dans votre <a href='index.php?Page=Cart'>panier</a>, veuillez y retourner pour payer.";
                
            }else header("Location: index.php?Page=Login");
                
        ?>
        
    </div>
</section>