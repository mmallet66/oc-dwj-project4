<?php

/**
 * Class user
 * 
 * Allows you to create a user object
 */
class user
{
// PROPERTIES
  /**
   * @var int
   */
  private $_id;

  /**
   * @var string
   */
  private $_login;

  /**
   * @var string
   */
  private $_password;

  /**
   * @var string
   */
  private $_eMail;

  /**
   * @var string
   */
  private $_role;

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

// SETTERS

  /**
   * @param string Value assigned to $_id property
   */
  private function setId($id)
  {
    $this->_id = (int) $id;
  }

  /**
   * @param string Value assigned to $_login property
   */
  public function setLogin(string $login)
  {
    if(is_string($login)):
      $this->_login = $login;
    endif;
  }

  /**
   * @param string Value assigned to $_password property
   */
  public function setPassword(string $password)
  {
    $this->_password = $password;
  }

  /**
   * @param string Value assigned to $_eMail property
   */
  public function setMail(string $eMail)
  {
    if(is_string($eMail)):
      $this->_eMail = $eMail;
    endif;
  }
  
  /**
   * @param string Value assigned to $_role property
   */
  public function setRole(string $role)
  {
    if(is_string($role)):
      $this->_role = $role;
    endif;
  }

// GETTERS
  public function getId() { return $this->_id; }
  public function getLogin() { return $this->_login; }
  public function getPasword() { return $this->_password; }
  public function getMail() { return $this->_eMail; }
  public function getRole() { return $this->_role; }
}