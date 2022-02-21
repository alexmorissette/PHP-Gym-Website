<?php

try {
    // Supprimer ou modifier
        if(isset($_POST['delete']) && isset($_POST['UserId'])) 
        {
            $query = "UPDATE utilisateurs ";
            $query .= "SET Actif = 0 ";
            $query .= "WHERE UserId = " . $_POST['UserId'];
            $cn->exec($query);
        }elseif(isset($_POST['updateAdmin']) && isset($_POST['UserId'])) 
        {
            $query = "UPDATE utilisateurs ";
            $query .= "SET isAdmin = not isAdmin ";
            $query .= "WHERE UserId = " . $_POST['UserId'];
            $cn->exec($query);
        }
        
        // Affichage des utilisateurs
        //Prepared statement
        $statement = $cn->prepare("SELECT UserId, Nom, Password, Email, Telephone, 
                                    isAdmin, Actif FROM utilisateurs WHERE Actif = 1 ORDER BY 1");
        $statement->execute();
        $result = $statement->fetchAll();

} catch (PDOException $ex) {
    echo $ex->getMessage();
}

    ?>

<section class="py-5 center">
    <div class="container px-4 px-lg-5 mt-5">
        <h1 class='m-3'>Gestion des utilisateurs</h1>
        <hr />
    <?php
        // Liste des utilsateurs 
        foreach ($result as $row) {
            echo "<form action='#' method='POST' name='form-data'>";
            echo "<div class='m-3'><h3>" . $row['Nom'] . "</h3>";
            echo "<input type='hidden' value='" . $row['UserId'] . "' name='UserId' />";
            echo "<div class='mx-3'>";
            echo "<div class='my-2 mx-2'><h4>Informations</h4></div>";
            echo "<div class='my-2 mx-4'>UserId: " . $row['UserId'] . "</div>";
            echo "<div class='my-2 mx-4'>Email: " . $row['Email'] . "</div>";
            echo "<div class='my-2 mx-4'>Téléphone: " . $row['Telephone'] . "</div>";
            echo "<div><label for='isAdmin' class='w-12 mx-4'>Administrateur</label>";
            if($row['isAdmin']) {
                echo "<input class='w-25' type='checkbox' checked id='isAdmin' name='isAdmin' />";
            }else{
                echo "<input class='w-25' type='checkbox' id='isAdmin' name='isAdmin' /></div>";
            } 
            if($row['Actif']) {
                "<input class='w-25' type='checkbox' hidden checked id='Actif' name='Actif' />";
            }
            echo "</div>";
            echo "</div>";
                echo "<button name='delete' class='btn btn-primary mx-3 w-25' type='submit'>Supprimer</button>";
                echo "<button name='updateAdmin' class='btn btn-primary mx-3 w-25' type='submit'>Mettre à jour</button>";
            echo "</form>";
            echo "<hr />";
        }
    ?>
  </div>
</section>