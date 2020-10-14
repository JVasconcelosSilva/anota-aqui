<?php

class connection
{

    public static function OpenCon()
    {

        $con = mysqli_init();
        mysqli_real_connect($con, "localhost", "root", "", "db_anota_gols", 3306);

        return $con;
    }

    function CloseCon($con)
    {
        $con->close();
    }
}
