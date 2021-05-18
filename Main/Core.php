<?php 
try {
    $Core = New Core($_GET["Module"], $_GET["Arguments"]);

} catch (\Throwable $th) {
    $Core = New Core();
}
Class Core
{
    Function __Construct($Module = "Index", $Arguments = "")
    {

    }
}
?>