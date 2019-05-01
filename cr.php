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
    if(isset($_GET['q'])) {
        if(strcmp($_GET['q'],"mentee")==0) {
            $roll=final_touch($_GET['roll']);
            $ret_arr=array();
            $query="SELECT * FROM mentors_mentee WHERE Mentor='$roll' ORDER BY Img DESC";
            if($result=$connection->query($query)) {
                if($result->num_rows==0) {
                    $ret_arr[]="none";
                }
                else {
                    while($row=$result->fetch_array()){
                        $roll_=$row["Mentee"];
                        $q="SELECT * FROM user_basic_data WHERE Roll_No='$roll_'";
                        if($res=$connection->query($q)) {
                            if($res->num_rows==0) {
                                $ret_arr[]="none";
                            }
                            else {
                                while($r=$res->fetch_array()){
                                    $ret_arr[]=array("Name"=>$r['Name'],"Roll_No"=>$r["Roll_No"],
                                                     "Img"=>$row['Img'],"Dept"=>$r["Dept"]);
                                }
                            }
                        }
                        else {
                            $ret_arr[]="fail";
                        }
                    }
                }
            }
            else {
                $ret_arr[]="fail";
            }
            echo json_encode($ret_arr);
        }
        else if(strcmp($_GET['q'],"mentor")==0) {
            $roll=final_touch($_GET['roll']);
            $ret_arr=array();
            $query="SELECT * FROM mentors_mentee WHERE Mentee='$roll' ORDER BY Img DESC";
            if($result=$connection->query($query)) {
                if($result->num_rows==0) {
                    $ret_arr[]="none";
                }
                else {
                    while($row=$result->fetch_array()){
                        $roll_=$row["Mentor"];
                        $q="SELECT * FROM user_basic_data WHERE Roll_No='$roll_'";
                        if($res=$connection->query($q)) {
                            if($res->num_rows==0) {
                                $ret_arr[]="none";
                            }
                            else {
                                while($r=$res->fetch_array()){
                                    $gend=$r["Gender"];
                                    $val="";
                                    if($gend=="Male") {
                                        $val="boy";
                                    }
                                    else {
                                        $val="girl";
                                    }
                                    $ret_arr[]=array("Name"=>$r['Name'],"Roll_No"=>$r["Roll_No"],
                                                     "Img"=>$val,"Dept"=>$r["Dept"]);
                                }
                            }
                        }
                        else {
                            $ret_arr[]="fail";
                        }
                    }
                }
            }
            else {
                $ret_arr[]="fail";
            }
            echo json_encode($ret_arr);
        }
        
    }
    else {
        header("Location:./index.php");
    }
}
else if(!logged_in_session()) {
    if(isset($_GET['q'])) {
        if(strcmp($_GET['q'],"all")==0) {
            $ret_arr=array();
            $query="SELECT * FROM class_reps ORDER BY Year DESC";
            if($result=$connection->query($query)) {
                if($result->num_rows==0) {
                    $ret_arr[]="none";
                }
                else {
                    while($row=$result->fetch_array()){
                        $ret_arr[]=array("Name"=>$row['Name'],"Roll_No"=>$row["Roll_No"],
                                         "Img"=>$row['Img'],"Year"=>$row['Year'],"Dept"=>$row['Dept'],
                                        "Sec"=>$row['Sec']);
                    }
                }
            }
            else {
                $ret_arr[]="fail";
            }
            echo json_encode($ret_arr);
        }
        else {
            header("Location:./index.php");
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