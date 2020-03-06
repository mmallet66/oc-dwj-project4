<?php

class ChapterController
{
  public $chapterManager;
  public $chapter;

  public function __construct()
  {
    $this->chapterManager = new ChapterManager();
    $this->chapter = new Chapter();
  }

  /**
   * Call the "readSynopsis" view
   */
  public function readSynopsis()
  { $this->chapter->hydrate($this->chapterManager->getChapter(1));
    $data = $this->chapterManager->getChaptersPublished();

    require "view/front-office/readSynopsis.php";
  }

  /**
   * Call the "readChapter" view
   */
  public function readChapter(int $chapterId)
  {
    $this->chapter->hydrate($this->chapterManager->getChapter($chapterId));
    if($this->chapter->getId() && $this->chapter->getId() != 1)
    {
      $this->commentManager = new CommentManager;
      $comments = $this->commentManager->getCommentsOfChapter($chapterId);
      require "view/front-office/readChapter.php";
    }
    else
    {
      throw new Exception("Une erreur est survenue");
    }
  }

  public function chapterAdministration()
  {
    $chapters = $this->chapterManager->getChapters();

    require "view/back-office/administration.php";
  }
}