<?php
require 'database.php';
require 'session.php';

function final_touch($field) {
    $field = trim($field);
    $field = stripslashes($field);
    $field = htmlspecialchars($field);
    return $field ;
}

if(logged_in_session()){
	header("Location: index.php");
}
else if(isset($_GET['q'])&&(strcmp($_GET['q'],"true")==0)) {
    $a=1;$b=1;
    $ret_arr=array();
    $roll=final_touch($_GET['u']);
    $sq=final_touch($_GET['sq']);
    $sa=final_touch($_GET['sa']);
    $q1="SELECT * FROM user_basic_data WHERE Roll_No='$roll'";
    if($res1=$connection->query($q1)){
        if($res1->num_rows>0) {
            $q2="SELECT * FROM user_basic_data WHERE S_Q='$sq' AND S_A='$sa'";
            if($res2=$connection->query($q2)){
                if($res2->num_rows>0) {
                    $ret_arr=array("a"=>$a,"b"=>$b );
                    echo json_encode($ret_arr);
                }
                else {
                    $b=0;
                    $ret_arr=array("a"=>$a,"b"=>$b );
                    echo json_encode($ret_arr);
                    return;
                }
            }
            else {
                $b="conn_error";
                $ret_arr=array("a"=>$a,"b"=>$b );
                echo json_encode($ret_arr);
                return;
            }
        }
        else {
            $a=0;
            $ret_arr=array("a"=>$a,"b"=>$b );
            echo json_encode($ret_arr);
            return;
        }
    }
    else {
        $a="conn_error";
        $ret_arr=array("a"=>$a,"b"=>$b );
        echo json_encode($ret_arr);
        return;
    }
    
}
else if(isset($_POST['q'])&&(strcmp($_POST['q'],"false")==0)) {
    $user=final_touch($_POST['User']);
    $psw=final_touch($_POST['Psw']);
    $encrypt=password_hash($psw,PASSWORD_BCRYPT);
    $query="UPDATE user_basic_data SET Password='$encrypt' WHERE Roll_No='$user'";
    if($result=$connection->query($query)) {
        echo "true";
    }
    else {
        echo "false";
    }
    
}
else {
    header("Location: index.php");
}
?>