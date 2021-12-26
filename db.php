<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "db_informasipetani";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

function cek_ada($field)
{
    if (isset($field) || !empty($field)) {
        return true;
    }
}

function custom_echo($x, $length)
{
  if(strlen($x)<=$length)
  {
    echo $x;
  }
  else
  {
    $y=substr($x,0,$length) . '...';
    echo $y;
  }
}
