<?php

class Router 
{
  public function traitment(){
    $frontController = new FrontController();
    $backController = new BackController();
    $connexionController = new ConnectionController();


    try
    {
      if(!isset($_GET["admin"]))
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
              if(isset($_GET["action"]))
              {
                if (session_status() == PHP_SESSION_NONE) {
                  session_start();
                }
                switch ( $_GET["action"])
                {
                  case "connect":
                    if($userRole = $connexionController->checkUser($_POST))
                    {
                      $_SESSION["username"] = $_POST["username"];
                      $_SESSION["role"] = $userRole;
                      $frontController->getAccueilPage();
                    }
                    else
                    {
                      $frontController->getLoginPage(true);
                    }
                  break;
      
                  case "disconnect":
                    session_unset();
                    $frontController->getAccueilPage();
                  break;
                }
              }
              else
              {
                $frontController->getLoginPage();
              }
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
      
            default:
              $frontController->getAccueilPage();
              break;
          }
        }
        elseif (isset($_GET["action"]) && $_GET["action"] == "makeAComment")
        {
          if(!empty($_POST["content"]) && $_GET["chapterId"] > 0)
          {
            $frontController->createComment([
              "author" => $_GET["author"],
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
      else
      {
        if (session_status() == PHP_SESSION_NONE) {
          session_start();
        }
        if($backController->accessControl())
        {
          switch($_GET["admin"]):
            case "accueil":
              $backController->getAccueilPage();
            break;
            case "administration":
            break;
            case "edition":
            break;
            case "moderation":
            break;
          endswitch;
        }
      }
    }
    catch(Exception $e)
    {
      $errorMessage = $e->getMessage();
      $frontController->getErrorPage($errorMessage);
    }
  }
}