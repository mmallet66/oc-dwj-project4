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
    $chapterManager = new ChapterManager();
    $chapter = new Chapter();

    $published = 1;
    $data = $chapterManager->getAllChapters($published);

    require "view/front-office/read.php";
  }

  /**
   * Call the "readChapter" page view
   */
  public function getReadChapter(int $chapterNumber)
  {
    $chapterManager = new ChapterManager();
    $commentManager = new CommentManager();

    $chapter = new Chapter();
    $comment = new Comment();

    $chapter->hydrate($chapterManager->getChapter($chapterNumber));
    $comments = $commentManager->getCommentsOfChapter($chapterNumber);

    require "view/front-office/readChapter.php";
  }
}