<?php 
IF(IsSet($_GET["Type"]))
{
    $Type = $_GET["Type"];
}
else {
    $Type = "Page";
}
IF(IsSet($_GET["Data"]))
{
    $Data = $_GET["Data"];
}
else {
    $Data = "Index";
}
IF(IsSet($_GET["Arguments"]))
{
    $Arguments = $_GET["Arguments"];
}
else {
    $Arguments = "";
}
$Core = New Core($Type, $Data, $Arguments);
Class Core
{
    Function __Construct($Type = "Page", $Data = "Index", $Arguments = "")
    {
        
        try {
            IF(File_Exists($Type."/".$Data.".php"))
            {
                Require $Type."/".$Data.".php";
                $Pack = New DataPack($Arguments);
            }
        } catch (Exception $th) {
            File_Put_Contents("./Log.php",File_Get_Contents("./Log.php")."<br>".$th);
        }
    }
}
?>