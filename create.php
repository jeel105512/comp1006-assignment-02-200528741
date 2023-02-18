<?php

    require_once("./connect.php");

    $sql = "INSERT INTO collections (
        name,
        description,
        value,
        signature_by
    ) VALUES (
        :name,
        :description,
        :value,
        :signature_by
    )";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":name", $_POST["name"], PDO::PARAM_STR);
    $stmt->bindParam(":description", $_POST["description"], PDO::PARAM_STR);
    $stmt->bindParam(":value", $_POST["value"], PDO::PARAM_STR);
    $stmt->bindParam(":signature_by", $_POST["signature_by"], PDO::PARAM_STR);
    $stmt->execute();

    // var_dump($_POST);

    header("Location: ./index.php");
?>