<?php

require_once "model/Chapter.php";
require_once "model/ChapterManager.php";

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

}