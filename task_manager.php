<?php
require 'database.php';
require 'session.php';

function final_touch($field) {
    $field = trim($field);
    $field = stripslashes($field);
    //$field = strip_tags($field);
    $field = htmlspecialchars($field);
    return $field ;
}

if(logged_in_session()) {
    if(isset($_POST['q'])) {
        if(strcmp($_POST['q'],"add")==0) {
           $link=final_touch($_POST['link']);
           $deadline=final_touch($_POST['deadline']);
           $taskno=final_touch($_POST['taskno']);
           $dom=final_touch($_POST['dom']);
           $subdom=final_touch($_POST['subdom']);
           $query="INSERT INTO tasks (Domain, Sub_Domain, Link, Deadline, Task_No) VALUES ('$dom','$subdom', '$link','$deadline','$taskno')";
           if($result=$connection->query($query)) {
              echo json_encode("true");
           }
           else {
              echo json_encode("false");
           }
        }
        else {
            header("Location:./index.php");
        }
    }
    else {
        header("Location:./index.php");
    }
}
else if(strcmp($_POST['q'],"Fetch")==0){
    $dom=final_touch($_POST['dom']);
    $query="SELECT * FROM tasks WHERE Domain='$dom'";
    $ret_arr=array();
    if($result=$connection->query($query)) {
        if($result->num_rows==0) {
            echo json_encode("0row");
        }
        else {
            while($row=$result->fetch_array()) {
                $taskno=$row['Task_No'];
                $ps=$row['PS'];
                $subd=$row['Sub_Domain'];
                $ret_arr[]=array("TaskNo"=>$taskno,"SubD"=>$subd,"PS"=>$ps);
            }
            echo json_encode($ret_arr);
        }
    }
    else {
        echo json_encode("false");
    }
}
else {
    header("Location:./index.php");
}
?>