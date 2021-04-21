<?php

class connection
{

    public static function OpenCon()
    {

        $con = mysqli_init();
        // mysqli_real_connect($con, "localhost", "root", "", "db_prototipo_ranking", 3306);
        mysqli_real_connect($con, "localhost", "root", "", "anota_aqui", 3306);

        return $con;
    }

    function CloseCon($con)
    {
        $con->close();
    }
}
