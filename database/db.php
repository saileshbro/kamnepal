<?php
function cleanse($str){
    global $con;
    return mysqli_real_escape_string($con, strip_tags(stripslashes($str)));
}

function getColumn($sql, $col){
    global $con;

    $r = "";

    $result = mysqli_query($con, $sql);
    while($row=mysqli_fetch_array($result)){
        $r = $row[$col];
    }
    
    return $r;
}

class Database {
    public $con;

    function __construct(){
        $this->con = mysqli_connect("localhost","root","","kamnepal");
    }

    function __destruct(){
        mysqli_close($this->con);
    }
}
?>