<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $objToUpdates = (object)$_POST;

    foreach ($objToUpdates as $rkey => $value) {
        echo $rkey . ' = ' . $value . '<br>';
    }
    echo "<br>Table Name: " . $_SESSION['tableName'];



    // If update is for parent ________________________________
    if ($_SESSION['tableName'] == 'parent') {
        include '../../models/parent/parent_class.php';
        echo "<br>Parent called";
        try {
            $upd = new parent7();
            $upd->change($objToUpdates, $_SESSION['selectedId']);
            header('Location: ./database.php');
        } catch (PDOException $e) {
            echo "An exception occurred: " . $e->getMessage();
        }
    }
    // __________________________________________________

    // If is teacher =================================================
    if ($_SESSION['tableName'] == 'teachers') {
        include('../../models/teacher/teacher_class.php');
        $teacherObj = new Teacher;
        $teacherObj->edit($objToUpdates, $_SESSION['selectedId']);
    }
    // ===========================================================


    // if applicant is the table chosen =====================================
    if ($_SESSION['tableName'] == 'applicant') {
        try {
            include('../../models/applicant/applicant_class.php');
            $applicantObj = new applicant($objToUpdates);
            $applicantObj->update($_SESSION['selectedId'], $objToUpdates);
            header('Location: database.php');
        } catch (Throwable $th) {
            throw $th;
        }
    }
    // ===========================================================


    // If table is student===============================================
    if ($_SESSION['tableName'] == 'students') {
        include('../../models/students/students_class.php');
        $studentObj = new students;
        $studentObj->edit($objToUpdates, $_SESSION['selectedId']);
        header("Location: ../../php/admission.php");
    }

    if ($_SESSION['tableName'] == 'bank') {
        include('../../models/bank/bank_class.php');
        $bank = new Bank;
        $bank->edit($objToUpdates, $_SESSION['selectedId']);
        header("Location: database.php");
    }

    if ($_SESSION['tableName'] == 'fee') {
        include('../../models/fee/fee_class.php');
        $fee = new Fee;
        $fee->edit($objToUpdates, $_SESSION['selectedId']);
        header("Location: database.php");
    }
}
