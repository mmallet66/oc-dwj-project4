<?php

/**
 * Class ChapterManager
 * 
 * Allows you create a chapter manager. Insert, recover, update, delete, a chapter in a database
 */
class ChapterManager extends Manager
{
// PROPERTIES
  /**
   * @var object PDO Stores the connection with the database
   */
  private $_db;

// METHODS
  public function __construct()
  {
    $this->_db = $this->dbConnect();
  }

  /**
   * @param object $chapter
   * 
   * @return $affectedLines Number of rows affected in the database or false if an error occured
   */
  public function addChapter(object $chapter)
  {
    $req = $this->_db->prepare("INSERT INTO chapters (number_order, title, content) VALUES (?, ?, ?)");

    $affectedLines = $req->execute(array(
      $chapter->getNumberOrder(),
      $chapter->getTitle(),
      $chapter->getContent()
    ));

    return $affectedLines;
  }

  /**
   * @param object $chapter
   * 
   * @return $affectedLines Number of rows affected in the database or false if an error occured
   */
  public function updateChapter($data)
  {
    $req = $this->_db->prepare("UPDATE chapters SET number_order=?, title=?, content=?, published=? WHERE id=?");

    $affectedLines = $req->execute($data);

    return $affectedLines;
  }

  /**
   * @param int $published 0 or 1, allows to choose all published chapters or all chapters 
   * 
   * @return object Return a PDOStatement Object, or false if an error occured
   */
  public function getAllChapters(int $published=0)
  {
    switch($published)
    {
      case 1:
        $req = $this->_db->prepare("SELECT id, number_order AS numberOrder, title, content, published FROM chapters WHERE published=?");
        $req->execute(array($published));
        break;
      case 0:
        $req = $this->_db->query("SELECT id, number_order AS numberOrder, title, content, published FROM chapters");
        break;
    }

    return $req;
  }

  /**
   * @param integer $chapterId
   * 
   * @return array Data of a chapter
   */
  public function getChapter(int $chapterId)
  {
    $req = $this->_db->prepare("SELECT id, number_order AS numberOrder, title, content, published FROM chapters WHERE id=?");
    $req->execute(array($chapterId));

    $chapter = $req->fetch();

    return $chapter;
  }

  /**
   * @param integer $chapterId
   * 
   * @return $affectedLines Number of rows affected in the database or false if an error occured
   */
  public function removeChapter(int $chapterId)
  {
    $req = $this->_db->prepare("DELETE FROM chapters WHERE id=?");

    $affectedLines = $req->execute(array($chapterId));

    return $affectedLines;
  }
}