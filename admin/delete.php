<?php
session_start();
// include('dbcon.php');
require_once "../connection.php";

if(isset($_POST['delete_student']))
{
    $student_id = $_POST['delete_student'];

    try {

        $query = "DELETE FROM event_registrations WHERE id=:stud_id";
        $statement = $pdo->prepare($query);
        $data = [
            ':stud_id' => $student_id
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            $_SESSION['message'] = "Deleted Successfully";
            header('Location: index.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Deleted";
            header('Location: index.php');
            exit(0);
        }

    } catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>