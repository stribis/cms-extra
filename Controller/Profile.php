<?php
require_once(__dir__ . '/Controller.php');
require_once(dirname(__DIR__) . '/Model/RegisterModel.php');
require_once(dirname(__DIR__) . '/Model/ProfileModel.php');
class Profile extends Controller
{
  public $active = 'profile'; //for highlighting the active link...
  private $profileModel;
  private $registerModel;

  /**
   * @param null|void
   * @return null|void
   * ? Checks if the user session is set and creates a new instance of the ProfileModel...
   **/
  public function __construct()
  {
    if (!isset($_SESSION['auth_status'])) header("Location: index.php");
    $this->profileModel = new ProfileModel();
    $this->registerModel = new RegisterModel();
  }

  /**
   * @param null|void
   * @return array
   * ? Returns an array containing the logged in user...
   **/
  public function getUser(): array
  {
    return $this->profileModel->fetchUser($_SESSION['data']['id']);
  }

  /**
   * @param array
   * @return array
   * ? Redirects user to profile after editing given user data
   **/
  public function editUser(array $data): array
  {
    $name = stripcslashes(strip_tags($data['name']));
    $email = stripcslashes(strip_tags($data['email']));

    $Error = array(
      'name' => '',
      'email' => '',
      'status' => false
    );

    $EmailStatus = $this->registerModel->fetchUser($email)['status'];

    if (preg_match('/[^A-Za-z\s]/', $name)) {
      $Error['name'] = 'Only Alphabets are allowed.';
      return $Error;
    }

    if (!empty($EmailStatus)) {
      $Error['email'] = 'Sorry. This Email Address has been taken.';
      return $Error;
    }

    $Payload = array(
      'name' => $name,
      'email' => $email,
      'id' => $_SESSION['data']['id']
    );

    $Response = $this->profileModel->updateUser($Payload);
    if (!$Response['status']) {
      $Response['status'] = 'Sorry, An unexpected error occurred and your request could not be completed.';
      return $Response;
    }
    header("Location: /profile?updated");
    return array(true);
  }

  /**
   * @param array
   * @return array
   * ? Redirects user to profile after changing their password
   **/
  public function changePassword(array $data): array
  {
    $password = stripcslashes(strip_tags($data['password']));
    $repeatPassword = stripcslashes(strip_tags($data['passwordRepeat']));

    $Error = array(
      'password' => '',
      'status' => false
    );

    if (strlen($password) < 7) {
      $Error['password'] = 'Please, use a stronger password.';
      return $Error;
    }

    if ($password != $repeatPassword) {
      $Error['password'] = 'Your passwords do not match';
      return $Error;
    }

    $Payload = array(
      'password' => password_hash($password, PASSWORD_BCRYPT),
      'id' => $_SESSION['data']['id']
    );

    $Response = $this->profileModel->updatePassword($Payload);
    if (!$Response['status']) {
      $Response['status'] = 'Sorry, An unexpected error occurred and your request could not be completed.';
      return $Response;
    }
    header("Location: /profile?updated");
    return array(true);
  }
}
