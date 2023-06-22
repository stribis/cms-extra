<?php

class Db
{
  protected $dbName = 'cms-example';
  /** Database Name */
  protected $dbHost = 'localhost';
  /** Database Host */
  protected $dbUser = 'root';
  /** Database Root */
  protected $dbPass = 'root';
  /** Database Password */
  protected $dbHandler, $dbStmt;


  /**
   * @param null|void
   * @return null|void
   * ? Creates or resumes an existing database connection
   */
  public function __construct()
  {
    // Connection DSN
    $dsn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
    // Additional PDO Options
    $options = array(
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    // Try PDO Connection
    try {
      $this->dbHandler = new PDO($dsn, $this->dbUser, $this->dbPass, $options);
    } catch (Exception $e) {
      var_dump('Could not establish a database connection due to the following reason: ' . $e->getMessage());
    }
  }

  /**
   * @param string
   * @return null|void
   * ? Creates a PDO statement object
   */
  public function query($query)
  {
    $this->dbStmt = $this->dbHandler->prepare($query);
  }

  /**
   * @param string|integer|
   * @return null|void
   * ? Matches the correct datatype to the PDO Statement Object.
   **/
  public function bind($param, $value, $type = null)
  {
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
          break;
      }
    }
    $this->dbStmt->bindValue($param, $value, $type);
  }

  /**
   * @param null|void
   * @return null|void
   * ? Executes a PDO Statement Object or a db query...
   **/
  public function execute()
  {
    $this->dbStmt->execute();
    return true;
  }

  /**
   * @param null|void
   * @return null|void
   * ? Executes a PDO Statement Object and returns a single database record as an associative array...
   **/
  public function fetch()
  {
    $this->execute();
    return $this->dbStmt->fetch(PDO::FETCH_ASSOC);
  }


  /**
   * @param null|void
   * @return null|void
   * ? Executes a PDO Statement Object and returns multiple database record as an associative array...
   **/
  public function fetchAll()
  {
    $this->execute();
    return $this->dbStmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
