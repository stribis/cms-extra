<?php
  require_once(__dir__ . '/Controller.php');
  require_once('Model/RegisterModel.php');
  class Register extends Controller {

    public $active = 'Register'; //for highlighting the active link...
    private $registerModel;

    /**
      * @param null|void
      * @return null|void
      * ? Checks if the user session is set and creates a new instance of the RegisterModel...
    **/
    public function __construct()
    {
      if (isset($_SESSION['auth_status'])) header("Location: dashboard.php");
      $this->registerModel = new RegisterModel();
    }

    /**
      * @param array
      * @return array|boolean
      * ? Verifies, Creates, and returns a user by calling the register method on the RegisterModel...
    **/
    public function register(array $data)
    {
      $name = stripcslashes(strip_tags($data['name']));
      $email = stripcslashes(strip_tags($data['email']));
      $password = stripcslashes(strip_tags($data['password']));
      $repeatPassword = stripcslashes(strip_tags($data['passwordRepeat']));

      $EmailStatus = $this->registerModel->fetchUser($email)['status'];

      $Error = array(
        'name' => '',
        'email' => '',
        'password' => '',
        'status' => false
      );

      if (preg_match('/[^A-Za-z\s]/', $name)) {
        $Error['name'] = 'Only Alphabets are allowed.';
        return $Error;
      }

      if (!empty($EmailStatus)) {
        $Error['email'] = 'Sorry. This Email Address has been taken.';
        return $Error;
      }

      if ($password != $repeatPassword) {
        $Error['password'] = 'Your passwords do not match';
        return $Error;
      }

      if (strlen($password) < 7) {
        $Error['password'] = 'Please, use a stronger password.';
        return $Error;
      }

      $Payload = array(
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
      );

      $Response = $this->registerModel->createUser($Payload);

      $Data = $this->registerModel->fetchUser($email)['data'];
      unset($Data['password']); //Makes a whole lot of sense to get rid of any critical information...

      if (!$Response['status']) {
        $Response['status'] = 'Sorry, An unexpected error occurred and your request could not be completed.';
        return $Response;
      }

      $_SESSION['data'] = $Data;
      $_SESSION['auth_status'] = true;
      header("Location: /dashboard");
      return true;
    }
  }
 ?>
