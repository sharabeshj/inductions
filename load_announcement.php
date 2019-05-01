<?php
require 'database.php';
require 'session.php';

function final_touch($field) {
    $field = trim($field);
    $field = stripslashes($field);
    $field = htmlspecialchars($field);
    return $field ;
}

if(!logged_in_session()) {
    if(isset($_GET['q'])) {
        if(strcmp($_GET['q'],"home")==0) {
            $ret_arr=array();
            $query="SELECT * FROM announcements ORDER BY Date";
            if($result=$connection->query($query)) {
                if($result->num_rows>0) {
                    while($row=$result->fetch_array()) {
                        $roll=$row['Roll'];
                        $title=$row['Title'];
                        $body=$row['Body'];
                        $imp=$row['Imp'];
                        $date=$row['Date'];
                        $name="";
                        $q1="SELECT * FROM user_basic_data WHERE Roll_No='$roll'";
                        if($res=$connection->query($q1)) {
                            if($res->num_rows>0) {
                                while($r=$res->fetch_array()) {
                                    $name=$r['Name'];
                                }
                            }
                            else {
                                $name="";
                            }
                        }
                        else {
                            $name="";
                        }
                        $ret_arr[]=array("Name"=>$name,"Title"=>$title,"Body"=>$body,"Imp"=>$imp,"Date"=>$date);
                    }
                }
                else {
                    $ret_arr[]="no";
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
else if(logged_in_session()) {
    if(isset($_GET['q'])) {
        if(strcmp($_GET['q'],"accnt")==0) {
            $ret_arr=array();
            $query="SELECT * FROM announcements ORDER BY Date";
            if($result=$connection->query($query)) {
                if($result->num_rows>0) {
                    while($row=$result->fetch_array()) {
                        $roll=$row['Roll'];
                        $title=$row['Title'];
                        $body=$row['Body'];
                        $imp=$row['Imp'];
                        $date=$row['Date'];
                        $name="";
                        $q1="SELECT * FROM user_basic_data WHERE Roll_No='$roll'";
                        if($res=$connection->query($q1)) {
                            if($res->num_rows>0) {
                                while($r=$res->fetch_array()) {
                                    $name=$r['Name'];
                                }
                            }
                            else {
                                $name="";
                            }
                        }
                        else {
                            $name="";
                        }
                        $ret_arr[]=array("Name"=>$name,"Title"=>$title,"Body"=>$body,"Imp"=>$imp,"Date"=>$date);
                    }
                }
                else{
                    $ret_arr[]="no";
                }
            }
            else {
                $ret_arr[]="fail";
            }
            echo json_encode($ret_arr);
        }
        else if(strcmp($_GET['q'],"add")==0) {
           $roll=final_touch($_GET['roll']);
           $title=final_touch($_GET['title']);
           $body=final_touch($_GET['body']);
           $imp=final_touch($_GET['imp']);
           date_default_timezone_set("Asia/Kolkata");
           $date=date("Y-m-d");
           $query="INSERT INTO announcements (Title, Body, Imp, Roll, Date) VALUES ('$title','$body','$imp','$roll','$date')";
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
else {
    header("Location:./index.php");
}
?>