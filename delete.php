<?php

    require_once("./connect.php");

    $sql = "DELETE FROM collections WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $_GET["id"], PDO::PARAM_INT);
    $stmt->execute();

    header("Location: ./index.php");

?>