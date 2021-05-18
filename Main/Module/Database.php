<?php 
Class DataPack
{
    Private $Arguments = "";
    Private $DBc;
    Private $RegType = Array
    (
        "User", "Pass", "Email"
    );
    Function __Construct($Arguments)
    {
        IF(!File_Exists("../Config/Database.php"))
        {
            Die();
        }
        Require "../Config/Database.php";
        Try 
        {
            $this->DBc = new mysqli( $Config["Host"], $Config["User"], $Config["Pass"], $Config["Database"], $Config["Port"]);
        } 
        Catch (Mysqli_Sql_Exception $Ex) 
        {
            File_Put_Contents( "./Log.php",File_Get_Contents("./Log.php") . "<br>" . $Ex );
            ?>
            <script>
                $( "#MainFrame" ).load( "Main/Core.php");
            </script>
            <?php
            Die();
        }
        $this->Arguments = Explode("|", $Arguments);
        IF($this->Arguments[0] == "Login")
        {
            $this->Login();
        }
        IF($this->Arguments[0] == "Register")
        {
            $this->Register();
        }
       
    }
    Function ExecuteQuery($Query)
    {
        $Result = False;
        try {
            $Result = $this->DBc->Query($Query);
            echo $this->DBc -> error;
            Return $Result;
        }
        Catch (Mysqli_Sql_Exception $Ex) 
        {
            File_Put_Contents( "./Log.php",File_Get_Contents("./Log.php") . "<br>" . $Ex );
            ?>
            <script>
                $( "#MainFrame" ).load( "Main/Core.php");
            </script>
            <?php
            Die();
        }
    }
    Function Login()
    {
        $Query = "SELECT * FROM account WHERE User='".Mysqli_Real_Escape_String($this->DBc, $this->Arguments[1])."' AND Pass=md5('".Mysqli_Real_Escape_String($this->DBc, $this->Arguments[2])."');";
        $Result = $this->ExecuteQuery($Query);
        IF(!$Result)
        {
            ?>
            <script>
                $( "#MainFrame" ).load( "Main/Core.php");
            </script>
            <?php
            Die();
        }
        else 
        {
           IF($Result->num_rows <= 0)
           {
            ?>
            <script>
                $( "#Error" ).load( "Main/Core.php?Type=Error&Data=Login");
            </script>
            <?php
           }
           Else
           {
               Echo "da ma da";
           }
        }
    }
    Function Register()
    {
        $C = count($this->RegType);
        $I2 = 1;
        $I = 0;
        $Query = "SELECT * FROM account WHERE ";
        ForEach($this-RegType as $Type)
        {
            $Query = $Query . $Type . "=" . Mysqli_real_Escape_String($this-Arguments[$I2]);
            if($I != $C)
            {
                $Query = $Query . " OR ";
            }
            $I++;
        }
        $Result = $this->ExecuteQuery($Query);
        $Query = "INSERT INTO account (";
        $I = 0;
        ForEach($this-RegType as $Type)
        {
            $Query = $Query . $Type;
            if($I != $C)
            {
                $Query = $Query . ", ";
            }
            $I++;
        }
        $I2 = 1;
        $Query = $Query . ") VALUES (";
        ForEach($this-RegType as $Type)
        {
            $Query = $Query . mysqli_Real_Escape_String($this->Arguments[$I2]);
            if($I != $C)
            {
                $Query = $Query . ", ";
            }
            $I++;
            $I2++;
        }
        $Query = $Query . ");";
        try {
            $this->DBc->Query($Query);
        }
        Catch (Mysqli_Sql_Exception $Ex) 
        {
            File_Put_Contents( "./Log.php",File_Get_Contents("./Log.php") . "<br>" . $Ex );
            ?>
            <script>
                $( "#MainFrame" ).load( "Main/Core.php");
            </script>
            <?php
            Die();
        }
    }
}
?>