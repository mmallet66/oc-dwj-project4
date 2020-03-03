<?php

class Router 
{
  public function traitment(){
    try
    {
      if (isset($_GET["action"]))
      {
        switch($_GET["action"])
        {
          case "about":
            require "view/front-office/about.php";
          break;

          case "read-synopsis":
            $chapterController = new ChapterController();
            $chapterController->readSynopsis();
          break;

          case "read-chapter":
            if(isset($_GET["chapterId"]))
            {
              $chapterId = $_GET["chapterId"];
            }
            if(isset($_POST["chapterId"]))
            {
              $chapterId = $_POST["chapterId"];
            }
            $chapterController = new ChapterController();
            $chapterController->readChapter($chapterId);
          break;

          case "report-comment":
            $commentId = $this->getParameter($_GET, "commentId");
            $commentController = new CommentController();
            $commentController->reportComment($commentId);
          break;
          
          case "login":
            require "view/front-office/login.php";
          break;

          case "connect":
          break;

          case "disconnect":
            session_unset();
          break;

          case "registration":
            require "view/front-office/registration.php";
          break;

          case "new-user":
            $userData = array(
              "login" => $this->getParameter($_POST, "login"),
              "mail" => $this->getParameter($_POST, "mail"),
              "password" => $this->getParameter($_POST, "password")
            );
            $userController = new UserController();
            $userController->addNewUser($userData);
          break;

          default:
            throw new Exception("Oups ! Cette page n'existe pas.");
          break;
        }
      }
      else
      {
        require "view/front-office/accueil.php";
      }
    }
    catch(Exception $e)
    {
      $errorMessage = $e->getMessage();
      require "view/front-office/error.php";
    }
  }

  private function getParameter($container, $key) {
    if (isset($container[$key])) {
        return $container[$key];
    }
    else
        throw new Exception("Paramètre '$key' absent");
  }
}