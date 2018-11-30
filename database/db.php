<?php
function cleanse($str){
    global $con;
    return mysqli_real_escape_string($con, strip_tags(stripslashes($str)));
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