<?php
    
    // require_once("./connect.php");
    
    // // extra
    // //----------------------------------------------------
    // $limit = 5;
    // $page = (int)($_GET["page"] ?? 1);
    // $offset = ($page * $limit) - $limit;
    // //----------------------------------------------------

    // $sql = "SELECT 
    // id, name, description, value, signature_by
    // FROM
    // collections";

    // //-----------------------------------------------------
    // $stmt = $conn->query($sql);
    // $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // $sql = "SELECT 
    // id, name, description, value, signature_by
    // FROM
    // collections
    // LIMIT {$limit}
    // OFFSET {$offset}";

    // $total_count = $stmt->rowCount();
    // // var_dump($total_count);
    // //-------------------------------------------------------
    // // extra end

    // $rows = [];
    // if($conn){
    //     $rows = $conn->query($sql)->fetchAll(PDO::FETCH_OBJ);
    // }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    require_once("./connect.php");

    // Caching
    $total_count = isset($_COOKIE["total_collections_count"]) ? $_COOKIE["total_collections_count"] : 0;
    if($total_count == 0){
        $sql = "SELECT COUNT(id) as total FROM collections";
        $total_count = (int)$conn->query($sql)->fetch(PDO::FETCH_OBJ)->total;
        setcookie("total_collections_count", $total_count);
    }

    // pagination
    $limit = 5;
    $page = (int)($_GET["page"] ?? 1);
    $offset = ($page * $limit) - $limit;

    // fetch all rows
    $sql = "SELECT * FROM collections LIMIT {$limit} OFFSET :offset";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
    // var_dump($stmt);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
    // var_dump($rows);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
    <title>Collections</title>
</head>
<body>
<body class="container">
        <header class="my-5">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Collections</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a href="./index.php" class="nav-link">Home</a>
                            </li>

                            <li class="nav-item">
                                <a href="./new.php" class="nav-link">New Collection</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <h1 class="display-1 text-center">Collections</h1>
        </header>

        <table class="table table-striped table-light table-bordered">
            <thead class="table-light">
                <tr class="align-middle text-center">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Value (USD)</th>
                    <th>Signed By</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">
                <?php foreach ($rows as $row) : ?>
                    <tr>
                        <td><?= $row->id ?></td>
                        <td><?= $row->name ?></td>
                        <td><?= $row->description ?></td>
                        <td><?= $row->value ?></td>
                        <td><?= $row->signature_by ?></td>
                        <td>
                            <a href="./edit.php?id=<?= $row->id ?>" class="btn btn-success">Edit</a>
                            <a href="./delete.php?id=<?= $row->id ?>" onclick="return confirm('Are you absolutely sure you want to delete this because that will be after the point of no return and you can never get the data back again.')" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            <?php 
                $prev_en = ($page > 1) ? "" : "disabled";
                $next_en = (($page * $limit) < $total_count) ? "" : "disabled";
            ?>
            <nav>
                <?php
                $previous_enabled = $page > 1;
                $next_enabled = ($page * $limit) < $total_count;
                ?>
                <ul class="pagination">
                    <li class="page-item <?= $previous_enabled ? "" : "disabled" ?>"><a class="page-link" href="?page=<?= $previous_enabled ? $page - 1 : $page ?>">Previous</a></li>
                    <li class="page-item disabled"><span class="page-link" href="#"><?= $page ?></span></li>
                    <li class="page-item <?= $next_enabled ? "" : "disabled" ?>"><a class="page-link" href="?page=<?= $next_enabled ? $page + 1 : $page ?>">Next</a></li>
                </ul>
            </nav>
        </div>

    </body>
</body>
</html>