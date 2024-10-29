<?php

include 'ayarlar/db.php';

if(isset($_POST["add_to_do"])){
    $title = $_POST["title"];
    $detail = $_POST["detail"];
    $deadline = $_POST["deadline"];
    $category = $_POST["category"];
    $solution = $_POST["solution"];

    $sql = "INSERT INTO todo (title, detail, deadline, category, solution) VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "sssss", $title, $detail, $deadline, $category, $solution);

    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit();
}