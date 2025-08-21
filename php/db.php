<php

$conn =mysqli_connect("localhost","root","","cinema");

if($conn){
    echo "Connected";
} else{
    echo "Not connected" . mysqli_error($conn);
}

?>