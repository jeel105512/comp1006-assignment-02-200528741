<?php

    require_once("./connect.php");

    $sql = "UPDATE collections SET
        name = :name,
        description = :description,
        value = :value,
        signature_by = :signature_by
    WHERE id=:id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
    $stmt->bindParam(":name", $_POST["name"], PDO::PARAM_STR);
    $stmt->bindParam(":description", $_POST["description"], PDO::PARAM_STR);
    $stmt->bindParam(":value", $_POST["value"], PDO::PARAM_STR);
    $stmt->bindParam(":signature_by", $_POST["signature_by"], PDO::PARAM_STR);
    $stmt->execute();

    header("Location: ./index.php");
?>