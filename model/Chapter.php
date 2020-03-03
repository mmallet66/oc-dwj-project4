<?php

/**
 * Class Comment
 * 
 * Allows you to create a chapter object
 */
class Chapter
{
  /**
   * @var int Chapter identifier in the database
   */
  private $_id;

  /**
   * @var int Number order of the chapter
   */
  private $_number;

  /**
   * @var string Chapter title, it can contain html tags
   */
  private $_title;

  /**
   * @var html Text of the chapter, it contains html tags
   */
  private $_content;

  /**
   * @var int 0 or 1, serves as a boolean for know if the chapter is published or not
   */
  private $_published;

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
   * @param int $number Value assigned to $_number property
   */
  public function setNumber($number)
  {
    $number = (int) $number;

    if ($number > 0)
    {
      $this->_number = $number;
    }
  }

  /**
   * @param html Value assigned to $_title property
   */
  public function setTitle($html)
  {
    if (is_string($html))
    {
      $this->_title = $html;
    }
  }

  /**
   * @param html Value assigned to $_content property
   */
  public function setContent($html)
  {
    if (is_string($html))
    {
      $this->_content = $html;
    }
  }

  /**
   * @param int Value assigned to $_published property
   */
  public function setPublished($state)
  {
    $published = (int) $state;

    if ($published === 0 || $published === 1)
    {
      $this->_published = $published;
    }
  }


// GETTERS :
  public function getId() { return $this->_id; }
  public function getNumber() { return $this->_number; }
  public function getTitle() { return $this->_title; }
  public function getContent() { return $this->_content; }
  public function getPublished() { return $this->_published; }

}