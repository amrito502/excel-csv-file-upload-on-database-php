<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-4 my-3 shadow" style="border: 1px solid green;">
            <?php 
            if(isset($_SESSION['status'])){
                echo $_SESSION['status'];
                unset($_SESSION['status']);
            }
            
            
            ?>
                <form action="code.php" method="post" enctype="multipart/form-data">
                    <label class="mb-2" for="csv">Excel/CSV File Upload</label>
                    <input type="file" name="inport_file" id="csv" class="form-control">
                    <button type="submit" name="import_file_btn" class="btn btn-success mt-3">Import File</button>
                    <a href="" class="btn btn-info mt-3">Download File</a>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 p-4 my-3 shadow" style="border: 1px solid green;">
                <table class="table table-borderd">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Depertment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>