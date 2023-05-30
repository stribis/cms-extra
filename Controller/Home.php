<?php
  require_once(__dir__ . '/Controller.php');
  require_once('Model/HomeModel.php');
  class Home extends Controller {

    public $active = 'home'; //for highlighting the active link...
    private $homeModel;

    public function __construct(){
      $this->homeModel = new HomeModel();
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns an array of news by calling the DashboardModel fetchNews method...
    **/
    public function getPosts() :array {
      return $this->homeModel->fetchPosts();
    }
}

?>