<section class="py-3 center">
    <div class="container px-4 px-lg-5 mt-3 justify-content-center m-auto w-50">
        <?php
        // Insert
        if (isset($_POST['insert'])
            && isset($_POST['id'])
            && isset($_POST['nom'])
            && isset($_POST['description'])
            && isset($_POST['prix'])
            && isset($_FILES['image']['name'])) 
            {
                InsererProduit($cn);
        }
        if (isset($_POST['insert']) && (empty($_POST['nom']) || empty($_POST['description'])
        || empty($_POST['prix']) || empty($_FILES['image']['name'])))
        {
            echo "<div>SVP, Veuillez renseigner tous les champs.</div>";
        }
        if(isset($_POST['close'])){
            header("Location:index.php");
        }

function InsererProduit($cn){
    try {
        $destDir = "../assets/img/catalogue/";
        $filename = $destDir . basename($_FILES['image']['name']);
        if ($filename != $destDir) {
            move_uploaded_file($_FILES['image']['tmp_name'], $filename);
        
            $query = "INSERT INTO produits (nom, description, prix, image) VALUES "; // Besoin de mettre toutes les colonnes car elles sont non-nullables
            $query .= "('" . $_POST['nom'] . "', '" . $_POST['description'] . "'," . $_POST['prix'] . ", '" . $filename . "')";
        
            $cn->exec($query);
        
            echo "<div class='alert alert-success'>Produit ajouté avec succès</div>";
        }

    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}

        ?>

        <!-- // Ajout  -->
        <div class="m-3">
            <h3>Ajout d"un produit</h3>
        </div>
        <form enctype="multipart/form-data" action="#" class="form-horizontal mx-5" method="POST">
            <div>Nom: <input class="form-data" type="text" value="" name="nom" /></div>
            <input type="hidden" name="id" />
            <div>Description: <input class="form-data" type="text" value="" name="description" /></div>
            <div>Prix: <input class="form-data" type="number" value="" name="prix" /></div>
            <div>Image: <input class="form-data" type="file" value="" name="image" /></div>
            <div><button class="btn btn-primary m-3" name="insert" type="submit">Ajouter le produit</button>
                <a href="index.php"><button class="btn btn-primary m-3" value="" name="close">Fermer</button></a>


            </div>
        </form>
    </div>
</section>