<?php
  require_once(__dir__ . '/Controller.php');
  require_once( dirname(__DIR__) .'/Model/DashboardModel.php');
  class Dashboard extends Controller {

    public $active = 'dashboard'; //for highlighting the active link...
    private $dashboardModel;

    /**
      * @param null|void
      * @return null|void
      * ? Checks if the user session is set and creates a new instance of the DashboardModel...
    **/
    public function __construct()
    {
      if (!isset($_SESSION['auth_status'])) header("Location: index.php");
      $this->dashboardModel = new DashboardModel();
    }

    /**
      * @param int
      * @return array
      * ? Returns an array of news by calling the DashboardModel fetchNews method...
    **/
    public function getPosts(int $id) :array
    {
      return $this->dashboardModel->fetchPosts($id);
    }

    /**
      * @param int
      * @return array
      * ? Returns an array of news by calling the DashboardModel fetchNews method...
    **/
    public function getPost(int $id) :array
    {
      return $this->dashboardModel->fetchPost($id);
    }

    /**
      * @param int
      * @return null|void
      * ? Returns an array of news by calling the DashboardModel fetchNews method...
    **/
    public function deletePost(int $id)
    {
      if ($this->dashboardModel->deletePost($id)) header("Location: /dashboard.php?deleted");
    }


    /**
      * @param array
      * @return array
      * ? Returns an array of news by calling the DashboardModel fetchNews method...
    **/
    public function createPost(array $data, $files):array
    {

      // Text form data
      $title = stripcslashes(strip_tags($data['title']));
      $email = stripcslashes(strip_tags($data['email']));
      $message = stripcslashes(strip_tags($data['message']));

      //image
      $file = $files['image'];
  
      // Get file details
      $fileName = $file['name'];
      $fileTmp = $file['tmp_name'];
      $fileSize = $file['size'];
      $fileError = $file['error'];

      // Image - Check for errors
      if ($fileError === UPLOAD_ERR_OK) {
        if ($fileSize <= 3 * 1024 * 1024) {
            // Get the file extension
            $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            // Check allowed file types (jpg, png, gif, webp)
            $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif', 'webp');
            if (in_array($extension, $allowedExtensions)) {
                // Generate a unique name for the image
                $uniqueName = uniqid('image_') . '_' . time();

                // Append the file extension to the unique name
                $uniqueName .= '.' . $extension;

                // Move the uploaded file to a directory
                $uploadPath = '../uploads/' . $uniqueName;
                move_uploaded_file($fileTmp, $uploadPath);

                echo "Image uploaded successfully!";
            } else {
                echo "Only JPG, PNG, GIF, and WebP files are allowed.";
            }
        } else {
          $Error['image'] = 'The image must be less than 3 MB.';
          return $Error;
        }
      } else {
        $Error['image'] = 'Error uploading image. Please try again.';
        return $Error;
      }

      $Error = array(
        'title' => '',
        'email' => '',
        'message' => '',
        'image' => '',
        'status' => false
      );

      if (preg_match('/[^A-Za-z\s]/', $title)) {
        $Error['title'] = 'Only Alphabets are allowed.';
        return $Error;
      }

      if (strlen($message) < 20) {
        $Error['message'] = 'Please write a longer Message';
        return $Error;
      }

      $Payload = array(
        'title' => $title,
        'email' => $email,
        'message' => $message,
        'image' => $uniqueName
      );



      $Response = $this->dashboardModel->createPost($Payload);

      if (!$Response['status']) {
        $Response['status'] = 'Sorry, An unexpected error occurred and your request could not be completed.';
        return $Response;
      }

      
      header("Location: /dashboard?created");
      return true;
    }


    /**
      * @param array
      * @return array
      * ? Returns an array of news by calling the DashboardModel fetchNews method...
    **/
    public function editPost(array $data, int $id, $files):array
    {
      $title = stripcslashes(strip_tags($data['title']));
      $email = stripcslashes(strip_tags($data['email']));
      $message = stripcslashes(strip_tags($data['message']));
      $image = $data['original'];

      $Error = array(
        'title' => '',
        'email' => '',
        'message' => '',
        'image' => '',
        'status' => false
      );


      if (isset ($files['image']['name']) && $files['image']['size'] >0 ){
        $imageName = $data['original'];
        $imagePath = '../uploads/' . $imageName;

        $file = $files['image'];
        // Get file details
        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        // Check for errors
        if ($fileError === UPLOAD_ERR_OK) {
          // Delete the original image
          if (file_exists($imagePath)) {
              unlink($imagePath);
          }
        // Get the file extension
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Check allowed file types (jpg, png, gif, webp)
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        if (in_array($extension, $allowedExtensions)) {
            // Generate a unique name for the new image
            $uniqueName = uniqid('image_') . '_' . time();

            // Append the file extension to the unique name
            $uniqueName .= '.' . $extension;

            // Move the uploaded file to the directory
            $uploadPath = '../uploads/' . $uniqueName;
            move_uploaded_file($fileTmp, $uploadPath);

            $image = $uniqueName;
            // echo "Image updated successfully!";
        } else {
            $Error['image'] = "Only JPG, PNG, GIF, and WebP files are allowed.";
            return $Error;
        }
    } else {
      $Error['image'] = "Error uploading image. Please try again.";
      return $Error;
    }
      }

      if (preg_match('/[^A-Za-z\s]/', $title)) {
        $Error['title'] = 'Only Alphabets are allowed.';
        return $Error;
      }

      if (strlen($message) < 20) {
        $Error['message'] = 'Please write a longer Message';
        return $Error;
      }

      $Payload = array(
        'title' => $title,
        'email' => $email,
        'message' => $message,
        'image' => $image
      );

      $Response = $this->dashboardModel->updatePost($Payload, $id);

      if (!$Response['status']) {
        $Response['status'] = 'Sorry, An unexpected error occurred and your request could not be completed.';
        return $Response;
      }

      
      header("Location: /dashboard?updated");
      return array(true);
    }
  }
 ?>