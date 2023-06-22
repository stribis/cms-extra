<?php
require_once(__dir__ . '/Db.php');
class ProfileModel extends Db
{

  /**
   * @param int
   * @return array
   * ? Returns an array with logged in user info
   **/
  public function fetchUser(int $id): array
  {
    $this->query("SELECT * FROM `db_user` WHERE `id` = :id");
    $this->bind('id', $id);
    $this->execute();

    $User = $this->fetch();
    if (!empty($User)) {
      $Response = array(
        'status' => true,
        'data' => $User
      );
      return $Response;
    }
    return array(
      'status' => false,
      'data' => []
    );
  }

  /**
   * @param array
   * @return array
   * ? updates user info and returns true if successful
   **/
  public function updateUser(array $data): array
  {
    $this->query("UPDATE `db_user` SET name=:name, email=:email WHERE id=:id");
    $this->bind('name', $data['name']);
    $this->bind('email', $data['email']);
    $this->bind('id', $data['id']);
    $this->execute();


    if ($this->execute()) {
      $Response = array(
        'status' => true,
      );
      return $Response;
    } else {
      $Response = array(
        'status' => false
      );
      return $Response;
    }
  }

  /**
   * @param array
   * @return array
   * ? Updates user info and returns true if successful
   **/
  public function updatePassword(array $data): array
  {
    $this->query("UPDATE `db_user` SET password=:password WHERE id=:id");
    $this->bind('password', $data['password']);
    $this->bind('id', $data['id']);
    $this->execute();


    if ($this->execute()) {
      $Response = array(
        'status' => true,
      );
      return $Response;
    } else {
      $Response = array(
        'status' => false
      );
      return $Response;
    }
  }
}
