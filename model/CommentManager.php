<?php

require_once "Manager.php";
require_once "Comment.php";

/**
 * Class CommentManager
 * 
 * Allows you create a comment manager. Insert, recover, update, delete, a chapter in a database
 */
class CommentManager extends Manager
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
   * @param object $comment
   * 
   * @return affectedLines Number of rows affected in the database or false if an error occured
   */
  public function addComment(object $comment)
  {
    $req = $this->_db->prepare("INSERT INTO comments (author, content, chapter_number, DATE_FORMAT(date_comment, '%d/%m/%Y à %Hh%imin%ss') AS dateComment) VALUES (?, ?, ?, NOW()");

    $affectedLines = $req->execute(array(
      $comment->getAuthor(),
      $comment->getContent(),
      $comment->getChapterNumber()
    ));

    return $affectedLines;
  }
  
  /**
   * @param integer Chapter number order
   * 
   * @return object Return a PDOStatement Object, or false
   */
  public function getCommentsOfChapter(int $chapterNumber)
  {
    $req = $this->_db->prepare("SELECT id, author, content, reported, chapter_number AS chapterNumber, DATE_FORMAT(date_comment, '%d/%m/%Y à %Hh%imin%ss') AS dateComment FROM comments WHERE chapter_number=?");
    $req->execute(array($chapterNumber));

    return $req;
  }

  /**
   * @param integer 0 or 1, serves as a boolean for know if the comment is reported or not
   * 
   * @return object Return PDOStatement Object, or false
   */
  public function getReportedComments(int $reported)
  {
    $req = $this->_db->prepare("SELECT id, author, content, reported, chapter_number AS chapterNumber FROM comments WHERE reported=?");
    $req->execute(array($reported));

    return $req;
  }

  /**
   * @param integer Comment identifier
   * 
   * @return int Number of rows affected in the database or false if an error occured
   */
  public function removeComment(int $commentId)
  {
    $req = $this->_db->prepare("DELETE FROM comments WHERE id=?");

    $affectedLines = $req->execute(array($commentId));

    return $affectedLines;
  }

  /**
   * @param integer Chapter identifier
   * 
   * @return int Number of rows affected in the database or false if an error occured
   */
  public function removeCommentsOfChapter(int $chapterNumber)
  {
    $req = $this->_db->prepare("DELETE FROM comments WHERE chapter_number=?");

    $affectedLines = $req->execute(array($chapterNumber));

    return $affectedLines;
  }

  /**
   * @param integer Comment identifier
   * 
   * @return int Number of rows affected in the database or false if an error occured
   */
  public function updateComment(int $commentId)
  {
    $req = $this->_db->prepare("UPDATE comments SET author, content, reported WHERE id=?");
    $affectedLines = $req->execute(array($commentId));

    return $affectedLines;
  }

}