<?php

require_once "controller/front-office/FrontController.php";

$frontController = new FrontController();


try
{
  if (isset($_GET["page"]))
  {
    switch($_GET["page"])
    {
      case "read":
        if(isset($_POST["chapterId"]) && $_POST["chapterId"] > 0)
        {
          $frontController->getReadChapter($_POST["chapterId"]);
        }
        elseif(isset($_GET["chapterId"]) && $_GET["chapterId"] > 0)
        {
          $frontController->getReadChapter($_GET["chapterId"]);
        }
        elseif(isset($_GET["report"]))
        {
          $frontController->reportComment($_GET["commentId"]);
        }
        else{
          $frontController->getReadPage();
        }
        break;

      case "about":
        $frontController->getAboutPage();
        break;
      
      case "login":
        $frontController->getLoginPage();
        break;
    }
  }
  else
  {
    $frontController->getAccueilPage();
  }

}
catch(Exception $e)
{
  $errorMessage = $e->getMessage();
  $frontController->getErrorPage($errorMessage);
}