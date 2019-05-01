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
    $ret_arr=array();
    if(isset($_POST['change'])) {
        if(final_touch($_POST['change'])=="False") {
            $query="SELECT * FROM user_basic_data ORDER BY Roll_No";
            if($result=$connection->query($query)) {
                if($result->num_rows>0) {
                    while($res=$result->fetch_array()) {
                        $ret_arr[]=array("Roll_No"=>$res['Roll_No'],"Access"=>$res['Access']);
                    }
                }
                else {
                    $ret_arr[]="NDF";
                }
            }
            else {
                $ret_arr="ECF";
            }
            echo json_encode($ret_arr);
        } 
        else if((final_touch($_POST['change'])=="True")&&(isset($_POST['roll']))&&(isset($_POST['type']))) {
            $roll=final_touch($_POST['roll']);
            $val=final_touch($_POST['type']);
            $query="UPDATE user_basic_data SET Access='$val' WHERE Roll_No='$roll'";
            if($result=$connection->query($query)) {
                $ret_arr[]="true";
            }
            else {
                $ret_arr="false";
            }
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