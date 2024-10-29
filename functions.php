<?php

include 'ayarlar/db.php';

if(isset($_POST["delete_" . $_POST['fetched_id']])){
    $id = $_POST['fetched_id'];
    echo $id;

    $sql = "DELETE FROM todo WHERE id = ? LIMIT 1";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    header("Location: index.php");
    exit();
}

if(isset($_POST["update_" . $_POST['fetched_id']])){
    $id = $_POST['fetched_id']; 
    $status_num = $_POST["status"];

    if($status_num == 1){
        $status = "Done";
    }else if($status_num == 2){
        $status = "Dropped";
    }else if($status_num == 3){
        $status = "Waiting";
    }else if($status_num == 4){
        $status = "Under Maintain";
    }else{
        $status = $_POST['fetched_status'];
    }

    $sql = "UPDATE todo SET status = ? WHERE id = ? LIMIT 1";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "si", $status, $id);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    //DETAIL UPDATE

    $sql2 = "UPDATE todo SET detail = ? WHERE id = ? LIMIT 1";

    $stmt2 = $conn->prepare($sql2);

    if (!$stmt2) {
        
    } else {
        $detail = $_POST["detail"];
        $stmt2->bind_param("si", $detail, $id);

        $stmt2->execute();

        $stmt2->close();
    }

    //DEADLINE UPDATE

    $sql3 = "UPDATE todo SET deadline = ? WHERE id = ? LIMIT 1";

    $stmt3 = $conn->prepare($sql3);

    if (!$stmt3) {
        
    } else {
        $deadline = $_POST["deadline"];
        $stmt3->bind_param("si", $deadline, $id);

        $stmt3->execute();

        $stmt3->close();
    }

    //SOLUTION UPDATE

    $sql4 = "UPDATE todo SET solution = ? WHERE id = ? LIMIT 1";

    $stmt4 = $conn->prepare($sql4);

    if (!$stmt4) {
        
    } else {
        $solution = $_POST["solution"];

        $stmt4->bind_param("si", $solution, $id);

        $stmt4->execute();

        $stmt4->close();
    }


    header("Location: index.php");
    exit();
}