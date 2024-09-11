<?php
$servername = 'localhost';
$DBusername = 'root';
$DBpassword = '';
$dataBaseName = 'LoginDB';
$table = 'users';
$userInfoTable = 'user_info';
class Server
{
  private $servername;
  private $username;
  private $password;
  private $dataBaseName;


  public $DBconnect;

  function __construct($servername, $DBusername, $DBpassword, $dataBaseName)
  {
    $this->servername = $servername;
    $this->username = $DBusername;
    $this->password = $DBpassword;

    $this->DBconnect = $this->connectServer($servername, $DBusername, $dataBaseName, $DBpassword);
  }

  function addUser($database, $fname, $lname, $email, $password, $role)
  {
    $sql = "INSERT INTO tb_users (fname,lname,email,password,role) VALUES ('$fname' , '$lname' ,'$email' ,'$password' ,'$role')";
    $result = $database->exec($sql);
    if ($result) {
      echo "เพิ่มข้อมูลเรียบร้อยแล้ว";
    } else {
      echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูล";
    }
  }
  function register($connect, $table, $username, $password, $email, $role = 0 /*default role = User*/)
  {
    $sql = "INSERT INTO $table (username, password, email,role) VALUES (:username, :password, :email, :role)";
    $smt = $connect->prepare($sql);
    $registerUser = $smt->execute(["username" => $username, "password" => $password, "email" => $email, "role" => $role]);
    return $registerUser;
  }
  public function add_userInfo($conn, $table, $id, $email)
  {
    $sql = "INSERT INTO $table (id, fname, lname, email) VALUES (:id, :fname, :lname, :email)";
    $smt = $conn->prepare($sql);
    $data = $smt->execute(["id" => $id, 'fname' => "ยังไม่ได้ตั้ง", 'lname' => "ยังไม่ได้ตั้ง", 'email' => $email]);
    return $data;
  }
  function login($conn, $table, $email, $password)
  {
    $sql = "SELECT * FROM $table WHERE email = :email";
    $smt = $conn->prepare($sql);
    $smt->execute(["email" => $email]);
    $user = $smt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['email'] = $user['email'];
      
      $user_info = $this->getSoleByEmail($conn, 'user_info', $_SESSION['email']);
      $avatar = $user_info['avatar'] == "default_avatar.jpg" ? "image/" . $user_info['avatar'] : "image/upload/" . $user_info['avatar'];
      $fullname = ((isset($user_info['fname']) && $user_info['fname'] != "ยังไม่ได้ตั้ง") && (isset($user_info['lname']) && $user_info['lname'] != "ยังไม่ได้ตั้ง"))
        ? $user_info['fname'] . " " . $user_info['lname']
        : "ยังไม่ได้ตั้งชื่อ";
      $_SESSION['avatar'] = $avatar;
      $_SESSION['fullname'] = $fullname;
      echo "<script>console.log('Login Successfully')</script>";
      header("Location: ../index.php");
      exit(); // Ensure no further output after redirect
    } else {
      header("Location: login.php");
      exit();
    }
  }
  function connectServer($servername, $username, $dbname, $password)
  {
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // echo "เชื่อมต่อฐานข้อมูลสำเร็จ";
      return $conn;
    } catch (PDOException $e) {
      echo "เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . $e->getMessage();
      return null;
    }

  }
  public function getSole($conn, $table, $id)
  {
    $sql = "SELECT * FROM $table WHERE id = :id";
    $smt = $conn->prepare($sql);
    $smt->execute(["id" => $id]);
    $data = $smt->fetch(PDO::FETCH_ASSOC);
    if ($data) {
      echo "<script>console.log('fetched user')</script>";
    } else {
      echo "<script>console.log('error')</script>";
    }
    return $data;
  }

  public function getSoleByEmail($conn, $table, $email)
  {
    $sql = "SELECT * FROM $table WHERE email = :email";
    $smt = $conn->prepare($sql);
    $smt->execute(["email" => $email]);
    $data = $smt->fetch(PDO::FETCH_ASSOC);
    if ($data) {
      echo "<script>console.log('fetched user')</script>";
    } else {
      echo "<script>console.log('error')</script>";
    }
    return $data;
  }
  public function upload_picture($conn, $table, $id, $file, $targetDir)
  {
    if ($file['error'] === UPLOAD_ERR_OK) {
      // Get the file extension
      $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
      $randomFileName = uniqid(mt_rand(), true) . '.' . pathinfo($file["name"], PATHINFO_EXTENSION);
      // Create the target file path with the user's name and original extension
      $originalFileName = basename($file['name']);

      // Create the full path for the target file
      $targetFile = $targetDir . $randomFileName;

      // Check if the target directory exists; if not, create it
      if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
      }

      // Move the uploaded file to the target directory
      if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        // Insert the original file name into the database
        // $sql = "INSERT INTO $table (avatar) VALUES (:avatar)";
        // $stmt = $conn->prepare($sql);
        // $upload = $stmt->execute(["avatar"=>$originalFileName]);
        $sql = "UPDATE $table SET 
        avatar = :avatar
        WHERE id = :id";
        // Prepare statement
        $stmt = $conn->prepare($sql);
        $upload = $stmt->execute(["avatar" => $randomFileName, "id" => $id]);
        session_start();
        $_SESSION['avatar'] = $targetFile;

        return ['status' => $upload, 'fileName' => $randomFileName];

      } else {
        echo "Error moving the uploaded file.";
      }
    } else {
      echo "Error: " . $file['error'];
    }
  }
  public function update_user ($conn,$table,$email,$id){
    $sql = "UPDATE $table SET email = :email 
            WHERE id = :id
    ";
    $stmt = $conn->prepare($sql);
    $data = $stmt->execute(['email'=>$email,'id'=> $id]);
    return $data;

  }

  public function update_info($conn, $table_info,$table_users, $fname, $lname,$email, $id)
  {
    
    $sql = "UPDATE $table_info SET 
    fname = :fname,
    lname = :lname,
    email = :email
    WHERE id = :id";
    // Prepare statement
    $stmt = $conn->prepare($sql);
    $update_info = $stmt->execute(["fname" => $fname, "lname" => $lname,"email"=>$email, "id" => $id]);
    $last_op_id = $conn->lastInsertId();
    $update_user = $this->update_user($conn, $table_users, $email, $last_op_id);

    return ['update_info' => $update_info, 'update_user' => $update_user];
  }
  function getConnection()
  {
    return $this->DBconnect;
  }
}
;

$server = new Server($servername, $DBusername, $DBpassword, $dataBaseName);

$connect = $server->getConnection();


?>