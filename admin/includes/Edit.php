<!-- <section class="py-5 center"> -->
    <div class="container px-4 px-lg-5 mt-3 justify-content-center w-50">
        <?php
            try {
                // UPDATE 
                if(isset($_POST['update']))
                {
                    // Définition du chemin de destination pour l'image
                    $destDir = "../assets/img/catalogue/";
                    $filename = $destDir . basename($_FILES['myFile']['name']);

                    // Uddate sans une nouvelle image
                    if($filename == $destDir
                        && isset($_POST['id']) 
                        && !empty($_POST['nom']) 
                        && !empty($_POST['description'])
                        && !empty($_POST['prix']))
                        {
                            $query = "UPDATE produits ";
                            $query .= "SET nom='" . $_POST['nom'] 
                            . "', prix='" . $_POST['prix'] 
                            . "', description='" . $_POST['description']
                            . "' WHERE id=". $_POST['id'];
                            
                        echo "<div>Produit mis à jour avec succès</div>";

                        // Si le nouveau chemin de l'image n'existe pas, on update
                        }elseif($filename != $destDir && isset($_POST['id']) 
                        && !empty($_POST['nom']) 
                        && !empty($_POST['description']) 
                        && !empty($_POST['image']) 
                        && !empty($_POST['prix']))
                        {
                            move_uploaded_file($_FILES['myFile']['tmp_name'], $filename);

                            $query = "UPDATE produits ";
                            $query .= "SET nom='" . $_POST['nom'] 
                            . "', prix='" . $_POST['prix'] 
                            . "', description='" . $_POST['description'] 
                            . "', image='" . $filename
                            . "' WHERE id=". $_POST['id'];
                            
                            echo "<div>Produit mis à jour avec succès</div>";
                        }else{
                            echo "<div>Formulaire invalide</div>";
                        }
                        $cn->exec($query);
                        
                    }elseif(isset($_POST['close'])){
                        header("Location:index.php");
                    }

                // Affichage
                //Prepared statement
                $statement = $cn->prepare("SELECT id, nom, prix, description, image FROM produits WHERE id=" . $_SESSION['id']);
                $statement->execute();
                $result = $statement->fetch();
                // Modifier le produit
                echo "<div class='m-3'><h3>Modification d'un produit</h3></div>";
                    echo "<form enctype='multipart/form-data' class='form-data' action='#' method='post'>"; // front-end
                        echo "<input type='hidden' value='" . $result['id'] . "' name='id' />"; // front
                        echo "<div>Produit: " . $result['nom'] . "<input type='text' value='" . $result['nom'] . "' name='nom' /></div>";
                        echo "<div>Prix: " . $result['prix'] . "<input type='number' value='" . $result['prix'] . "' name='prix' /></div>";
                        echo "<div>Description: " . $result['description'] . "<input type='text' value='" . $result['description'] . "' name='description' /></div>";
                        echo "<input type='hidden' name='image' value='" . $result['image'] . "' />";
                        echo "<div><img src='" . $result['image'] . "' width='200px' height='auto' /></div>";
                    echo "<div><label>Sélectionnez une nouvelle image : </label>";
                    echo "<input class='btn btn-secondary w-50' type='file' name='myFile' /></div>";
                    echo "<div><button class='btn btn-primary m-3' name='update' type='submit'>Mettre à jour</button>";
                        echo "<button class='btn btn-primary m-3' name='close'>Fermer</button>";
                    echo "</div>";
                echo "</form>";
                
            } catch (PDOException $ex) {
                echo "Erreur " . $ex->getMessage();            
            }
            
        ?>
   </div>
</section>
