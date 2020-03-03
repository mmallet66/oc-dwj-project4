<?php
/**
 * Class BackController
 * 
 * Allows you to create a controller for back-office
 */
class BackController
{

  public $chapterManager;
  public $commentManager;
  public $chapter;
  public $comment;

  public function __construct()
  {
    $this->chapterManager = new ChapterManager();
    $this->chapter = new Chapter();
    $this->commentManager = new CommentManager();
    $this->comment = new Comment();
  }

  public function accessControl()
  {
    if(isset($_SESSION["role"]) && $_SESSION["role"] === "admin")
    {
      return true;
    }
    else
    {
      throw new Exception("Accès refusé");
    }
  }

  public function getAccueilPage()
  {
    require "view/back-office/accueil.php";
  }
}