<?php

require_once "model/Chapter.php";
require_once "model/ChapterManager.php";
require_once "model/Comment.php";
require_once "model/CommentManager.php";

/**
 * Class FrontController
 * 
 * Allows you to create a controller for front-office
 */
class FrontController
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

  /**
   * Call the accueil page view
   */
  public function getAccueilPage()
  {
    require "view/front-office/accueil.php";
  }

  /**
   * Call the "about" page view
   */
  public function getAboutPage()
  {
    require "view/front-office/about.php";
  }

  /**
   * Call the "login" page view
   */
  public function getLoginPage()
  {
    require "view/front-office/login.php";
  }

  /**
   * Call the "error" page view
   */
  public function getErrorPage(string $errorMessage)
  {
    require "view/front-office/error.php";
  }
  
  /**
   * Call the "read" page view
   */
  public function getReadPage()
  {
    $published = 1;
    $data = $this->chapterManager->getAllChapters($published);

    require "view/front-office/read.php";
  }

  /**
   * Call the "readChapter" page view
   */
  public function getReadChapter(int $chapterId)
  {
    $this->chapter->hydrate($this->chapterManager->getChapter($chapterId));
    $comments = $this->commentManager->getCommentsOfChapter($chapterId);

    require "view/front-office/readChapter.php";
  }

  /**
   * @param array $data
   */
  public function createComment(array $data)
  {
    $this->comment->hydrate($data);
    $affectedLine = $this->commentManager->addComment($this->comment);

    if ($affectedLine === false)
    {
        throw new Exception("Impossible d'ajouter le commentaire !");
    }
    else
    {
        header("Location: index.php?page=read&chapterId=" . $this->comment->getChapterId());
    }
  }

  /**
   * @param integer $commentId
   */
  public function reportComment(int $commentId)
  {
    $this->comment->hydrate($this->commentManager->getComment($commentId));

    if($this->comment->getReported() != 1)
    {
      $this->comment->setReported(1);
      $this->commentManager->updateComment($this->comment);
    }
    $url = 'index.php?page=read&chapterId=' . $this->comment->getChapterId();
    header("Location: $url");
  }
}