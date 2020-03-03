<?php

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
    $req = $this->_db->prepare('INSERT INTO comments(author, content, chapter_id, date_comment) VALUES (?, ?, ?, NOW())');

    $affectedLines = $req->execute(array(
      $comment->getAuthor(),
      $comment->getContent(),
      $comment->getChapterId()
    ));

    return $affectedLines;
  }

  /**
   * @param integer Comment identifier
   * 
   * @return array Data of a comment
   */
  public function getComment(int $commentId)
  {
    $req = $this->_db->query("SELECT id, author, content, reported, chapter_id AS chapterId, DATE_FORMAT(date_comment, '%d/%m/%Y à %Hh%imin%ss') AS dateComment FROM comments WHERE id=$commentId");

    return $req->fetch();
  }
  
  /**
   * @param integer Chapter number order
   * 
   * @return object Return a PDOStatement Object, or false
   */
  public function getCommentsOfChapter(int $chapterId)
  {
    $req = $this->_db->prepare("SELECT id, author, content, reported, chapter_id AS chapterId, DATE_FORMAT(date_comment, '%d/%m/%Y à %Hh%imin%ss') AS dateComment FROM comments WHERE chapter_id=? ORDER BY date_comment DESC");
    $req->execute(array($chapterId));

    return $req;
  }

  /**
   * @param integer 0 or 1 or false, serves as a boolean for know if the comment is reported or not
   * 
   * @return object Return PDOStatement Object, or false
   */
  public function getComments($reported=false)
  {
    if($reported === "0" || $reported === "1")
    {
        $req = $this->_db->prepare("SELECT id, author, content, reported, chapter_id AS chapterId, DATE_FORMAT(date_comment, '%d/%m/%Y à %Hh%imin%ss') AS dateComment FROM comments WHERE reported=? ORDER BY date_comment DESC");
        $req->execute(array($reported));
    }
    else
    {
      $req = $this->_db->query("SELECT id, author, content, reported, chapter_id AS chapterId, DATE_FORMAT(date_comment, '%d/%m/%Y à %Hh%imin%ss') AS dateComment FROM comments ORDER BY date_comment DESC");
    }

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
  public function removeCommentsOfChapter(int $chapterId)
  {
    $req = $this->_db->prepare("DELETE FROM comments WHERE chapter_id=?");

    $affectedLines = $req->execute(array($chapterId));

    return $affectedLines;
  }

  /**
   * @param object Comment object
   * 
   * @return int Number of rows affected in the database or false if an error occured
   */
  public function updateComment(object $comment)
  {
    $req = $this->_db->prepare("UPDATE comments SET author=?, content=?, reported=? WHERE id=?");
    $affectedLines = $req->execute(array(
      $comment->getAuthor(),
      $comment->getContent(),
      $comment->getReported(),
      $comment->getId()
    ));

    return $affectedLines;
  }

}