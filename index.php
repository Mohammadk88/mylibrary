<?php
include('inc/config.php');
include "showTableWithSearch.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/style.css">

    <title>Books</title>
</head>
<body>
<div>
    <div class="form">
        <h1> Make Your Library </h1>
        <form action="<?= PATH ?>/import.php" method="post" enctype="multipart/form-data">
            <div>
                <div>
                    <label>Import Your Books</label>
                </div>
                <div>
                    <input type="file" name="doc" accept="text/xml"/>
                </div>
                <div>
                    <small>Pleas Enter XML Files</small>
                </div>
            </div>
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
<hr />
<div>
    <div>
        <form action="<?= PATH ?>" method="get">
            <input style="width: 400px; margin-left: 10px; margin-right: 10px" name="search" value="<?=$_GET['search'] ?>" placeholder="Please enter author name">
            <button style="width: 100px" type="submit" >Search</button>
        </form>
    </div>
<table class="table">
    <thead>
        <tr>
            <th>Authors</th>
            <th>Books</th>
        </tr>
    </thead>
    <tbody>
    <?php
        foreach ($books as $book){
    ?>
    <tr>
        <td><?=$book->author ?> </td>
        <td><?=$book->book ?> </td>
    </tr>
    <?php
        }
    ?>
    </tbody>
</table>
</div>
<script src="assets/scripts.js"></script>
</body>
</html>