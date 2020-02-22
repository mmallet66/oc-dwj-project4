<?php

/**
 * Class Comment
 * 
 * Allows you to create a comment object
 */
class Comment
{
// PROPERTIES
  /**
   * @var int Comment identifier in the database
   */
  private $_id;

  /**
   * @var string The name of the author of the comment
   */
  private $_author;

  /**
   * @var string Text of the comment
   */
  private $_content;

  /**
   * @var int 0 or 1, serves as a boolean for know if the comment is reported or not
   */
  private $_reported;

  /**
   * @var int Identifier of the chapter concerned by the comment
   */
  private $_chapterId;

  /**
   * @var string Creation date of the comment (in french)
   */
  private $_dateComment;

// METHODS
  /**
   * Hydratation method
   * 
   * For each key in an array, it call the setter (if it exists) method for assigned a value to each property.
   * 
   * @param array $data
   */
  public function hydrate($data) {
    foreach ($data as $key => $value)
    {
      $method = "set" . ucfirst($key);

      if(method_exists($this, $method))
      {
        $this->$method($value);
      }
    }
  }

// SETTERS :
  /**
   * @param int $id Value assigned to $_id property
   */
  private function setId($id) {
    $this->_id = (int) $id;
  }

  /**
   * @param string $author Value assigned to $_author property
   */
  public function setAuthor($author)
  {
    if (is_string($author))
    {
      $this->_author = $author;
    }
  }

  /**
   * @param string $content Value assigned to $_content property
   */
  public function setContent($content)
  {
    if (is_string($content))
    {
      $this->_content = $content;
    }
  }

  /**
   * @param int Value assigned to $_reported property
   */
  public function setReported($state)
  {
    $reported = (int) $state;
    if ($reported === 0 || $reported === 1)
    {
      $this->_reported = $reported;
    }
  }
  
  /**
   * @param int $chapterId Value assigned to $_chapterId property
   */
  private function setChapterId($chapterId) {
    $this->_chapterId = (int) $chapterId;
  }

  /**
   * @param string  Value assigned to $_dateComment property
   */
  private function setDateComment($date) {
    if(is_string($date))
    {
      $this->_dateComment = $date;
    }
  }

// GETTERS :
  public function getId() { return $this->_id; }
  public function getAuthor() { return $this->_author; }
  public function getContent() { return $this->_content; }
  public function getReported() { return $this->_reported; }
  public function getChapterId() { return $this->_chapterId; }
  public function getDateComment() { return $this->_dateComment; }

}