<?php

class connection
{

    public static function OpenCon()
    {

        $con = mysqli_init();
        mysqli_real_connect($con, "localhost", "root", "", "anota_aqui_v1_1", 3306);

        return $con;
    }

    function CloseCon($con)
    {
        $con->close();
    }
}
