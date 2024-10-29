<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body style="background-color: rgb(34, 34, 34)">
    <div class="container">
    <div class="bd-example m-0 border-0">
        <nav>
            <div class="nav nav-tabs p-3 d-flex" id="nav-tab" role="tablist">
                <div class="me-auto">
                <button class="btn btn-success active me-2" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Project</button>
                <button class="btn btn-warning mx-2" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" tabindex="-1">University</button>
                <button class="btn btn-secondary ms-2" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false" tabindex="-1">Job</button>
                </div>  
                <div class="ms-auto">
                <a href="" class="btn btn-danger">Exit</a>
                </div>
            </div>
        </nav>



        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">


          <table class="table text-center table-dark table-striped-columns table-hover align-middle">
            <thead>
                <tr class="fs-5">
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Detail</th>
                    <th scope="col">Create Time</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Solution</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <form action="add.php" method="post">
                <tr>
                    <th scope="row">New Entry</th>
                    <td>
                        <input type="text" name="title" class="form-control bg-dark text-light">
                    </td>
                    <td>
                        <input type="text" name="detail" class="form-control bg-dark text-light">
                    </td>
                    <td>auto</td>
                    <td>
                        <input type="date" name="deadline" class="form-control bg-dark text-light">
                    </td>
                    <td>
                        <input type="text" name="solution" class="form-control bg-dark text-light">
                    </td>
                    <td>
                        <div class="row w-100">
                            <div class="col-8">
                                <select class="form-select bg-dark text-light" aria-label="Default select example">
                                    <option selected disabled value="0">Waiting</option>
                                </select>
                            </div>
                            <div class="col-4 text-end">
                                <input type="hidden" name="category" value="project">
                                <input type="submit" name="add_to_do" class="btn btn-success" value="Add">
                            </div>
                        </div>
                    </td>
                </tr>
                </form>
                <?php
            $select_todo = mysqli_query($conn, "SELECT * FROM `todo` WHERE category='project' ORDER BY CASE WHEN status = 'Under Maintain' THEN 1 WHEN status = 'Waiting' THEN 2 WHEN status = 'Done' THEN 3 WHEN status = 'Dropped' THEN 4 ELSE 5 END") or die('query failed');
            if(mysqli_num_rows($select_todo) > 0){
                while($fetch_todo = mysqli_fetch_assoc($select_todo)){
        ?>
                <form action="functions.php" method="post" onsubmit="return confirm('<?= htmlspecialchars($fetch_todo['title'], ENT_QUOTES) ?> Confirm ?');">
                    <tr>
                        <th scope="row" class="fs-4"><?= $fetch_todo["id"]?></th>
                        <td class="fs-5 col-2"><b><?= $fetch_todo["title"]?></b></td>
                        <td class="col-3">
                            <textarea type="text" name="detail" class="form-control bg-dark text-light"><?=htmlspecialchars($fetch_todo["detail"])?></textarea>
                        </td>
                        <td><?= $fetch_todo["create_time"]?></td>
                        <td class="col-1">
                            <input type="date" name="deadline" class="form-control bg-dark text-light" value="<?= $fetch_todo["deadline"]?>">
                        </td>
                        <td>
                            <textarea type="text" name="solution" class="form-control bg-dark text-light"><?=htmlspecialchars($fetch_todo["solution"])?></textarea>
                        </td>
                        <td class="col-3">
                            <div class="row w-100">
                                <div class="col-md-8 text-center">
                                    <?php
                                        if($fetch_todo["status"] == "Done"){?>
                                            <select class="form-select bg-success text-light" name="status" aria-label="Default select example">
                                        <?php }else if($fetch_todo["status"] == "Waiting"){ ?>
                                            <select class="form-select bg-secondary text-light" name="status" aria-label="Default select example">
                                        <?php }else if($fetch_todo["status"] == "Under Maintain"){ ?>
                                            <select class="form-select bg-warning text-dark" name="status" aria-label="Default select example">
                                        <?php }else if($fetch_todo["status"] == "Dropped"){ ?>
                                            <select class="form-select bg-danger text-dark" name="status" aria-label="Default select example">
                                        <?php } ?>
                                        <option selected disabled value="0"><?= $fetch_todo["status"]?></option>
                                        <option value="1">Done</option>
                                        <option value="2">Dropped</option>
                                        <option value="3">Waiting</option>
                                        <option value="4">Under Maintain</option>
                                    </select>
                                </div>

                                <div class="col-md-2 text-start">
                                    <input type="submit" name="update_<?=$fetch_todo["id"]?>" class="btn btn-warning" value="Update">
                                    <input type="hidden" name="fetched_id" value="<?=$fetch_todo["id"]?>">
                                    <input type="hidden" name="fetched_title" value="<?= $fetch_todo["title"]?>">
                                    <input type="hidden" name="fetched_detail" value="<?=htmlspecialchars($fetch_todo["detail"])?>">
                                    <input type="hidden" name="fetched_create_time" value="<?= $fetch_todo["create_time"]?>">
                                    <input type="hidden" name="fetched_deadline" value="<?=$fetch_todo["deadline"]?>">
                                    <input type="hidden" name="fetched_status" value="<?=$fetch_todo["status"]?>">
                                    <input type="hidden" name="fetched_status_num" value="<?=$fetch_todo["status"]?>">
                                    <input type="hidden" name="fetched_solution" value="<?=$fetch_todo["solution"]?>">
                                </div>
                                <div class="col-md-2 text-end">
                                    <input type="submit" name="delete_<?= $fetch_todo["id"]?>" class="btn btn-danger" value="X">
                                </div>
                            </div>
                        </td>
                    </tr>
                </form>
        <?php
                }
            }
        ?>

            </tbody>
            </table>    
          
          </div>



          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

          

          <table class="table text-center table-dark table-striped-columns table-hover align-middle">
            <thead>
                <tr class="fs-5">
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Detail</th>
                    <th scope="col">Create Time</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Solution</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <form action="add.php" method="post">
                <tr>
                    <th scope="row">New Entry</th>
                    <td>
                        <input type="text" name="title" class="form-control bg-dark text-light">
                    </td>
                    <td>
                        <input type="text" name="detail" class="form-control bg-dark text-light">
                    </td>
                    <td>auto</td>
                    <td>
                        <input type="date" name="deadline" class="form-control bg-dark text-light">
                    </td>
                    <td>
                        <input type="text" name="solution" class="form-control bg-dark text-light">
                    </td>
                    <td>
                        <div class="row w-100">
                            <div class="col-8">
                                <select class="form-select bg-dark text-light" aria-label="Default select example">
                                    <option selected disabled value="0">Under Maintain</option>
                                </select>
                            </div>
                            <div class="col-4 text-end">
                                <input type="hidden" name="category" value="university">
                                <input type="submit" name="add_to_do" class="btn btn-success" value="Add">
                            </div>
                        </div>
                    </td>
                </tr>
                </form>
                <?php
            $select_todo = mysqli_query($conn, "SELECT * FROM `todo` WHERE category='university'") or die('query failed');
            if(mysqli_num_rows($select_todo) > 0){
                while($fetch_todo = mysqli_fetch_assoc($select_todo)){
        ?>
                <form action="functions.php" method="post" onsubmit="return confirm('Confirm ?');">
                    <tr>
                        <th scope="row" class="fs-4"><?= $fetch_todo["id"]?></th>
                        <td class="fs-5"><b><?= $fetch_todo["title"]?></b></td>
                        <td>
                            <textarea type="text" name="detail" class="form-control bg-dark text-light"><?=htmlspecialchars($fetch_todo["detail"])?></textarea>
                        </td>
                        <td><?= $fetch_todo["create_time"]?></td>
                        <td>
                            <input type="date" name="deadline" class="form-control bg-dark text-light" value="<?= $fetch_todo["deadline"]?>">
                        </td>
                        <td>
                            <textarea type="text" name="solution" class="form-control bg-dark text-light"><?=htmlspecialchars($fetch_todo["solution"])?></textarea>
                        </td>
                        <td class="w-25">
                            <div class="row w-100">
                                <div class="col-md-8 text-center">
                                    <select class="form-select bg-dark text-light" name="status" aria-label="Default select example">
                                        <option selected disabled value="0"><?= $fetch_todo["status"]?></option>
                                        <option value="1">Done</option>
                                        <option value="2">Dropped</option>
                                        <option value="3">Waiting</option>
                                        <option value="4">Under Maintain</option>
                                    </select>
                                </div>

                                <div class="col-md-2 text-start">
                                    <input type="submit" name="update_<?=$fetch_todo["id"]?>" class="btn btn-warning" value="Update">
                                    <input type="hidden" name="fetched_id" value="<?=$fetch_todo["id"]?>">
                                    <input type="hidden" name="fetched_title" value="<?= $fetch_todo["title"]?>">
                                    <input type="hidden" name="fetched_detail" value="<?=htmlspecialchars($fetch_todo["detail"])?>">
                                    <input type="hidden" name="fetched_create_time" value="<?= $fetch_todo["create_time"]?>">
                                    <input type="hidden" name="fetched_deadline" value="<?=$fetch_todo["deadline"]?>">
                                    <input type="hidden" name="fetched_status" value="<?=$fetch_todo["status"]?>">
                                    <input type="hidden" name="fetched_status_num" value="<?=$fetch_todo["status"]?>">
                                    <input type="hidden" name="fetched_solution" value="<?=$fetch_todo["solution"]?>">
                                </div>
                                <div class="col-md-2 text-end">
                                    <input type="submit" name="delete_<?= $fetch_todo["id"]?>" class="btn btn-danger" value="X">
                                </div>
                            </div>
                        </td>
                    </tr>
                </form>
        <?php
                }
            }
        ?>

            </tbody>
            </table>    
          </div>
          <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            
          
          <table class="table text-center table-dark table-striped-columns table-hover align-middle">
                <thead>
                    <tr class="fs-5">
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Detail</th>
                        <th scope="col">Create Time</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Solution</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="add.php" method="post">
                    <tr>
                        <th scope="row">New Entry</th>
                        <td>
                            <input type="text" name="title" class="form-control bg-dark text-light">
                        </td>
                        <td>
                            <input type="text" name="detail" class="form-control bg-dark text-light">
                        </td>
                        <td>auto</td>
                        <td>
                            <input type="date" name="deadline" class="form-control bg-dark text-light">
                        </td>
                        <td>
                            <input type="text" name="solution" class="form-control bg-dark text-light">
                        </td>
                        <td>
                            <div class="row w-100">
                                <div class="col-8">
                                    <select class="form-select bg-dark text-light" aria-label="Default select example">
                                        <option selected disabled value="0">Under Maintain</option>
                                    </select>
                                </div>
                                <div class="col-4 text-end">
                                    <input type="hidden" name="category" value="job">
                                    <input type="submit" name="add_to_do" class="btn btn-success" value="Add">
                                </div>
                            </div>
                        </td>
                    </tr>
                    </form>
                    <?php
                $select_todo = mysqli_query($conn, "SELECT * FROM `todo` WHERE category='job'") or die('query failed');
                if(mysqli_num_rows($select_todo) > 0){
                    while($fetch_todo = mysqli_fetch_assoc($select_todo)){
            ?>
                    <form action="functions.php" method="post" onsubmit="return confirm('Confirm ?');">
                        <tr>
                            <th scope="row" class="fs-4"><?= $fetch_todo["id"]; ?></th>
                            <td class="fs-5"><b><?= $fetch_todo["title"]?></b></td>
                            <td>
                                <textarea type="text" name="detail" class="form-control bg-dark text-light"><?=htmlspecialchars($fetch_todo["detail"])?></textarea>
                            </td>
                            <td><?= $fetch_todo["create_time"]?></td>
                            <td>
                                <input type="date" name="deadline" class="form-control bg-dark text-light" value="<?= $fetch_todo["deadline"]?>">
                            </td>
                            <td>
                                <textarea type="text" name="solution" class="form-control bg-dark text-light"><?=htmlspecialchars($fetch_todo["solution"])?></textarea>
                            </td>
                            <td class="w-25">
                                <div class="row w-100">
                                    <div class="col-md-8 text-center">
                                        <select class="form-select bg-dark text-light" name="status" aria-label="Default select example">
                                            <option selected disabled value="0"><?= $fetch_todo["status"]?></option>
                                            <option value="1">Done</option>
                                            <option value="2">Dropped</option>
                                            <option value="3">Waiting</option>
                                            <option value="4">Under Maintain</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2 text-start">
                                        <input type="submit" name="update_<?=$fetch_todo["id"]?>" class="btn btn-warning" value="Update" id="update">
                                        <input type="hidden" name="fetched_id" value="<?=$fetch_todo["id"]?>">
                                        <input type="hidden" name="fetched_title" value="<?= $fetch_todo["title"]?>">
                                        <input type="hidden" name="fetched_detail" value="<?=htmlspecialchars($fetch_todo["detail"])?>">
                                        <input type="hidden" name="fetched_create_time" value="<?= $fetch_todo["create_time"]?>">
                                        <input type="hidden" name="fetched_deadline" value="<?=$fetch_todo["deadline"]?>">
                                        <input type="hidden" name="fetched_status" value="<?=$fetch_todo["status"]?>">
                                        <input type="hidden" name="fetched_status_num" value="<?=$fetch_todo["status"]?>">
                                        <input type="hidden" name="fetched_solution" value="<?=$fetch_todo["solution"]?>">
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <input type="submit" name="delete_<?= $fetch_todo["id"]?>" class="btn btn-danger" value="X">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </form>
            <?php
                    }
                }
            ?>

                </tbody>
                </table>    


          </div>
        </div>
    </div>
    </div>
    </body>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>


</html>