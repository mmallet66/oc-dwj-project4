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
    $req = $this->_db->prepare('INSERT INTO comments(author_id, content, chapter_id, date_comment) VALUES (?, ?, ?, NOW())');

    $affectedLines = $req->execute(array(
      $comment->getAuthorId(),
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
    $req = $this->_db->query("SELECT comments.id, author_id AS authorId, login AS authorLogin, content, reported, chapter_id AS chapterId, DATE_FORMAT(date_comment, '%d/%m/%Y %Hh%imin%ss') AS dateComment FROM comments LEFT JOIN users ON comments.author_id = users.id WHERE comments.id = $commentId");

    return $req->fetch();
  }
  
  /**
   * @param integer Chapter number
   * 
   * @return object Return a PDOStatement Object, or false
   */
  public function getCommentsOfChapter(int $chapterId)
  {
    $req = $this->_db->prepare("SELECT comments.id, author_id AS authorId, login AS authorLogin, content, reported, chapter_id AS chapterId, DATE_FORMAT(date_comment, '%d/%m/%Y %Hh%imin%ss') AS dateComment FROM comments LEFT JOIN users ON comments.author_id = users.id WHERE chapter_id=? ORDER BY date_comment DESC");
    $req->execute(array($chapterId));

    return $req;
  }

  /**
   * @return object Return PDOStatement Object, or false
   */
  public function getComments()
  {
    $select = "SELECT comments.id, author_id AS authorId, login AS authorLogin, comments.content, reported, chapter_id AS chapterId, chapters.title AS chapterTitle, DATE_FORMAT(date_comment, '%d/%m/%Y %Hh%imin%ss') AS dateComment FROM comments LEFT JOIN users ON comments.author_id = users.id LEFT JOIN chapters ON comments.chapter_id = chapters.id ";
    $orderBy = " ORDER BY reported DESC, chapterId ASC, dateComment DESC";
  
    $req = $this->_db->query($select . $orderBy);

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
   * @param integer $commentId Comment's identifier
   * @param integer $reportingValue 0 or 1 for reported or not
   * 
   * @return int Number of rows affected in the database or false if an error occured
   */
  public function updateOfCommentReportingField(int $commentId, int $reportingValue)
  {
    $req = $this->_db->prepare("UPDATE comments SET reported=? WHERE id=?");
    $affectedLines = $req->execute(array(
      $reportingValue,
      $commentId
    ));

    return $affectedLines;
  }

}