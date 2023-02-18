<?php

    require_once("./connect.php");

    $sql = "SELECT 
        id, name, description, value, signature_by
    FROM
        collections
    WHERE
    id = :id";
    

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $_GET["id"], PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>

        <title>New Collection</title>
    </head>

    <body class="container">
        <header class="my-5">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="./index.php">Collections</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a href="./" class="nav-link">Home</a>
                            </li>

                            <li class="nav-item">
                                <a href="./new.php" class="nav-link">New Collection</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <h1 class="display-1 text-center">New Collection</h1>
        </header>

        <form action="./update.php" method="post">
            <input type="hidden" name="id" value="<?= $row->id ?>">    

            <div class="mb-3">
                <label for="name" class="form-label">Collection Name</label>
                <input type="text" class="form-control" name="name" placeholder="Pokemon Card" value="<?= $row->name ?>">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" name="description" placeholder="This card is of a rare Charizard pokemon..." value="<?= $row->description ?>">
            </div>

            <div class="mb-3">
                <label for="value" class="form-label">Collection Value ($)</label>
                <input type="text" class="form-control" name="value" placeholder="100000" value="<?= $row->value ?>">
            </div>
            
            <div class="mb-3">
                <label for="signature_by" class="form-label">Collection Signed By</label>
                <input type="text" class="form-control" name="signature_by" placeholder="Ash" value="<?= $row->signature_by ?>">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </body>

</html>