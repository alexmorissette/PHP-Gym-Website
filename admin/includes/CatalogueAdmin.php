<section class="py-3 center">
    <div class="container px-4 px-lg-5 mt-3 ">
        <h1 class='m-3'>Gestion des produits</h1>
        <div class='m-3'>
            <a href='index.php?Page=Ajout'>
                <button class='btn btn-primary' name='Ajout'>
                    Ajouter un produit
                </button>
            </a>
        </div>
        <hr />

        <?php
        try {
            // Supprimer et page modifier
            if (isset($_POST['delete']) && !empty($_POST['id'])) 
            {
                phpAlert('Vous allez supprimer ce produit...');
                $query = "DELETE FROM produits WHERE id = " . $_POST['id'];
                $cn->exec($query);
                echo "<div class='alert alert-success'>Produit supprimé avec succès.</div>";
                
            }elseif (isset($_POST['modif']) && !empty($_POST['id'])) 
            {
                $_SESSION['id'] = $_POST['id'];
                header("Location:index.php?Page=Edit&id=" . $_SESSION['id']);
            }
    
                // Affichage
            //Prepared statement
            $statement = $cn->prepare("SELECT id, nom, prix, description, image FROM produits ORDER BY 1 desc");
            $statement->execute(); //execute retourne un bool
            $result = $statement->fetchAll();
    
            // Liste des produits 
            foreach ($result as $row) {
                //$_SESSION['id'] = $row['id'];
                echo "<form action='#' method='Post' class='form-horizontal'>"; // front-end
                echo "<input type='hidden' value='" . $row['id'] . "' name='id' />"; // front
                echo "<div class='row row-cols-4 m-3'>";
                echo "<div class='col'><img src='" . $row['image'] . "' width='150px' height='auto' /></div>";
                echo "<div class='col'><h5>Produit: </h5>" . $row['nom'] . "</div>";
                echo "<div class='col'><h5>Description: </h5>" . $row['description'] . "</div>";
                echo "<div class='col'><h5>Prix: </h5>" . $row['prix'] . "</div>";
                echo "</div>";
                
                echo "<button name='delete' class='btn btn-primary mx-3 w-25'>Supprimer</button>";
                echo "<button name='modif' class='btn btn-primary mx-3 w-25'>Modifier</button>";
                echo "</form>";
                echo "<hr />";
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        ?>

  </div>
</section>