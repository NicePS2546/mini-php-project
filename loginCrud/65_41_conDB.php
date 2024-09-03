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
  function register($connect, $table,$username, $password, $email, $role = 0 /*default role = User*/)
  {
    $sql = "INSERT INTO $table (username, password, email,role) VALUES (:username, :password, :email, :role)";
    $smt = $connect->prepare($sql);
    $registerUser = $smt->execute(["username" => $username, "password" => $password, "email" => $email, "role" => $role]);
    return $registerUser;
  }
  public function add_userInfo($conn,$table,$id,$email){
    $sql = "INSERT INTO $table (id, fname, lname, email) VALUES (:id, :fname, :lname, :email)";
    $smt = $conn->prepare($sql);
    $data = $smt->execute(["id"=> $id,'fname'=>"ยังไม่ได้ตั้ง",'lname'=>"ยังไม่ได้ตั้ง",'email'=> $email]);
    return $data;
  }
  function login($conn, $table,$email, $password)
  {
    $sql = "SELECT * FROM $table WHERE email = :email";
    $smt = $conn->prepare($sql);
    $smt->execute(["email" => $email]);
    $user = $smt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['email'] = $user['email'];

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
  public function getSoleByEmail($conn, $table, $email){
    $sql = "SELECT * FROM $table WHERE email = :email";
    $smt = $conn->prepare($sql);
    $smt->execute(["email"=>$email]);
    $data = $smt->fetch(PDO::FETCH_ASSOC);
    if($data){
      echo "<script>console.log('fetched user')</script>";
    }else{
      echo "<script>console.log('error')</script>";
    }
    return $data;
  }

  function getConnection()
  {
    return $this->DBconnect;
  }
}
$server = new Server($servername, $DBusername, $DBpassword, $dataBaseName);

$connect = $server->getConnection();


?>