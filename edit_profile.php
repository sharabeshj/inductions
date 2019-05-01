<?php
require 'database.php';
require 'session.php';

function final_touch($field) {
    $field = trim($field);
    $field = stripslashes($field);
    $field = htmlspecialchars($field);
    return $field ;
}
if(logged_in_session()) {
    if(isset($_POST['id'])&&isset($_POST['key'])&&isset($_POST['val'])) {
        $ret_arr=array();
        $roll=final_touch($_POST['id']);
        $key=final_touch($_POST['key']);
        $val=final_touch($_POST['val']);
        if($key=="Name") {
            $query="UPDATE user_basic_data SET Name='$val' WHERE Roll_No='$roll'";
        }
        else if($key=="Department") {
            $query="UPDATE user_basic_data SET Dept='$val' WHERE Roll_No='$roll'";
        }
        else if($key=="Gender") {
            $query="UPDATE user_basic_data SET Gender='$val' WHERE Roll_No='$roll'";
        }
        else if($key=="Phone") {
            $query="UPDATE user_basic_data SET Phone='$val' WHERE Roll_No='$roll'";
        }
        else if($key=="Email") {
            $query="UPDATE user_basic_data SET Email='$val' WHERE Roll_No='$roll'";
        }
        else if($key=="Password") {
            $val=password_hash($val,PASSWORD_BCRYPT);
            $query="UPDATE user_basic_data SET Password='$val' WHERE Roll_No='$roll'";
        }
        if($result=$connection->query($query)){
            $ret_arr[]="true";
        }
        else {
            $ret_arr[]="fail";
        }
        echo json_encode($ret_arr);
    }
    else if(isset($_GET['id'])&&isset($_GET['key'])) {
        $ret_arr=array();
        $roll=final_touch($_GET['id']);
        $key=final_touch($_GET['key']);
        if($key=="del") {
            $query="DELETE FROM user_basic_data WHERE Roll_No='$roll'";
            if($result=$connection->query($query)){
                $ret_arr[]="true";
            }
            else {
                $ret_arr[]="fail";
            }
            echo json_encode($ret_arr);
        }
        else {
            $ret_arr[]="fail";
            echo json_encode($ret_arr);
        }
    }
    else {
        header("Location:./index.php");
    }
}
else {
    header("Location:./index.php");
}
?>