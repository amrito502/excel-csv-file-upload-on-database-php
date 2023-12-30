<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "excel_data_import");
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if (isset($_POST['import_file_btn'])) {
    $allowed_ext = ['xls', 'csv', 'xlsx'];
    $fileName = $_FILES['inport_file']['name'];
    $checking = explode(".", $fileName);
    $file_ext = end($checking);
    if (in_array($file_ext, $allowed_ext)) {
        $targetPath = $_FILES['inport_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetPath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        foreach ($data as $row) {
            $id = $row['0'];
            $std_name = $row['1'];
            $std_email = $row['2'];
            $std_phone = $row['3'];
            $std_depertment = $row['4'];

            $checkStudent = "SELECT id FROM student WHERE id='$id' ";
            $checkStudentResult = mysqli_query($conn, $checkStudent);
            if (mysqli_num_rows($checkStudentResult) > 0) {
                // already exists means please update
                $update_query = "UPDATE student SET name = '$std_name', email = '$std_email', phone = '$std_phone', depertment = '$std_depertment' WHERE id = '$id' ";
                $updateResult = mysqli_query($conn, $update_query);
                $msg = 1;
            } else {
                // new record hao toh insert
                $insertQuery = "INSERT INTO student(name, email, phone, depertment) VLAUES('$std_name','$std_email','$std_phone','$std_depertment')";
                $insertQuery = mysqli_query($conn, $insertQuery);
                $msg = 1;
            }
        }

        if(isset($msg)){
            $_SESSION['status'] = "File Imported Successfully";
            header("Location: index.php");
        }else{
            $_SESSION['status'] = "File Importing Fail";
            header("Location: index.php");
        }

    } else {
        $_SESSION['status'] = "Invalid File";
        header("Location: index.php");
        exit(0);
    }
}
