<?php
session_start();
require_once "controller/front-office/FrontController.php";
require_once "controller/front-office/ConnectionController.php";

$frontController = new FrontController();
$connexionController = new ConnectionController();


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

      case "registration":
        if(isset($_GET["action"]) && $_GET["action"] === "new")
        {
          $connexionController->addNewUser($_POST);
        }
        else
        {
          $frontController->getRegistrationPage();
        }
        break;
    }
  }
  elseif (isset($_GET["action"]) && $_GET["action"] == "makeAComment")
  {
    if(!empty($_POST["author"]) && !empty($_POST["content"]) && $_GET["chapterId"] > 0)
    {
      $frontController->createComment([
        "author" => $_POST["author"],
        "content" => $_POST["content"],
        "chapterId" => $_GET["chapterId"]
      ]);
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