<?php 
IF(IsSet($_GET["Type"]) && IsSet($_GET["Data"]) && IsSet($_GET["Arguments"]))
{
    $Core = New Core($_GET["Type"], $_GET["Data"], $_GET["Arguments"]);
}
ElseIF(IsSet($_GET["Data"]))
{
    $Core = New Core("Page", $_GET["Data"]);
}
Class Core
{
    Function __Construct($Type = "Page", $Data = "Index", $Arguments = "")
    {
        try {
            IF(File_Exists("Main/".$Type."/".$Data.".php"))
            {
                Require "Main/".$Type."/".$Data.".php";
                $Pack = New DataPack($Arguments);
            }
        } catch (Exception $th) {
            File_Put_Contents("./Log.php",File_Get_Contents("./Log.php")."<br>".$th);
        }
    }
}
?>