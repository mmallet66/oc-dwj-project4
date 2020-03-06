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

  public function deleteChapter($chapterId)
  {
    $affectedLine = $this->chapterManager->removeChapter($chapterId);

    if(!$affectedLine):
      throw new Exception("Une erreur est survenue, le chapitre n'a pas été supprimé");
    endif;

    header("Location: index.php?status=admin&action=administration");
  }

  public function publishChapter($chapterId)
  {
    $this->chapter->hydrate($this->chapterManager->getChapter($chapterId));

    if($this->chapter->getPublished() != 1):
      $this->chapter->setPublished(1);
    else:
      $this->chapter->setPublished(0);
    endif;

    $this->chapterManager->updateChapter($this->chapter);

    header("Location: index.php?status=admin&action=administration");
  }
}