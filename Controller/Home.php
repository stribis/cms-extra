<?php
require_once(__dir__ . '/Controller.php');
require_once('Model/HomeModel.php');
class Home extends Controller
{

  public $active = 'home'; //for highlighting the active link...
  private $homeModel;

  /**
   * @param null|void
   * @return null|void
   * ? Checks if the user session is set and creates a new instance of the HomeModel...
   **/
  public function __construct()
  {
    $this->homeModel = new HomeModel();
  }

  /**
   * @param null|void
   * @return array
   * ? Returns an array containing all posts...
   **/
  public function getPosts(): array
  {
    return $this->homeModel->fetchPosts();
  }
}
