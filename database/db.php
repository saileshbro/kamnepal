<?php
// cleanse function to cleanse the inputs
function cleanse($str)
{
    global $con;
    return mysqli_real_escape_string($con, strip_tags(stripslashes($str)));
}
// get column value
function getColumn($sql, $col)
{
    global $con;
    $r = "";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $r = $row[$col];
    }

    return $r;
}
// database class
class Database
{
    public $con;
    function __construct()
    {
        $this->con = mysqli_connect("localhost", "root", "", "kamnepal");
        if (mysqli_connect_errno()) {
            die();
        }
    }
    function __destruct()
    {
        mysqli_close($this->con);
    }
}
?>