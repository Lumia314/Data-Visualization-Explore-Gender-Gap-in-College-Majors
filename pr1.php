<!DOCTYPE HTML>
<html>
<head>
<style>
body{
  margin: 0;
  color: #F9FBF2;
  background: #c8c8c8;
  font: 600 18px/18px 'Open Sans';
  text-shadow: 1px 1px 3px #4C4C4C;
  text-align: center;
}

.login-wrap{
  width: 100%;
  margin: auto;
  margin-top: 30px;
  max-width: 525px;
  min-height: 570px;
  position: relative;
  background: url(sunset.jpg) no-repeat center;
  box-shadow: 0 12px 15px 0 rgba(0,0,0,.24), 0 17px 50px 0 rgba(0, 0, 0, .19);
  text-align: left;
}

.login-html .sign-in{
  display:none;
}
.login-html .tab,
.login-form .group .label,
.login-form .group .button{
  text-shadow: 1px 1px 3px #4C4C4C;
  color: #F9FBF2;
  font: 600 15px 'Open Sans';
}
.group {
  padding: 150px 70px 70px 70px;
}
.login-form .group .input,
.login-form .group .button{
  border: none;
  width: 90%;
  padding: 15px 20px;
  border-radius: 25px;
  background: rgba(255,255,255,.15);
} 
.login-form .group .label{
  color:#F9FBF2;
  font-size: 15px;
  text-shadow: 1px 1px 3px #4C4C4C;
}
.error{
  color:#F9FBF2;
  font-size: 12px;
  text-shadow: 1px 1px 3px #4C4C4C;
}
.login-form .group .button{
  background: #85BAA1;
}

</style>
</head>
<body>

<?php
//Tạo biến
$userName = $passWord = "";
$username = $password = "";
$usernameErr = $passErr = $loginErr = "";

//PHP logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (empty($_POST['username'])) {
    $usernameErr = "* Vui lòng nhập tên";
  } else {
    $userName = $_POST['username'];
  }
  if (empty($_POST['password'])) {
    $passErr = "* Vui lòng nhập mật khẩu";
  } else {
    $passWord = $_POST['password'];
  }
}

?>
<div class='login-wrap'>
<div class='login-form'>
<form class='sign-in-html' method='post' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>'>
  <table class='group' align="center">
    <tr>
      <td class='sign-in'><h2>Đăng nhập</h2></td>
    </tr>
    <tr>
      <td class='label'>Tên đăng nhập</td>
    </tr>
    <tr>
      <td><input class='input' type='text' name='username' value='<?php echo $username;?>'>
      <span class='error'><br><?php echo $usernameErr;?></span></br></td>
    </tr>
    <tr>
      <td class='label'>Mật khẩu</td>
    </tr>
    <tr>
      <td><input class='input' type='password' name='password' value='<?php echo $password;?>'>
      <span class='error'><br><?php echo $passErr;?></span></br></td>
    </tr>
    <tr>
      <span class='error'><?php echo $loginErr;?></span></td>
    </tr>
    <tr>
      <td><input class='button' type='submit' name='submit' value="Submit"></td>
    </tr>
  </table>
</form>
</div>
</div>
<?php
// Tạo connection
$servername = 'localhost';
$username = "root";
$password = '';
$database = 'myDB';
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
  die('Connection failed:' . $conn->connect_error);
}

// Tạo bảng 
$sql = 'CREATE TABLE project1 (
id INT(6) AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(30) NOT NULL,
password VARCHAR(30) NOT NULL
)';
$conn->query($sql);

// Kiểm tra username và password
$query = "SELECT * FROM project1 WHERE username='$userName' and password='$passWord'";
$result = mysqli_query($conn, $query);
$rows = mysqli_num_rows($result);
if ($rows==0) {
  echo 'Incorrect username/password.';
} else {
  $_SESSION['username'] = $_POST['username'];
  header('Location: pr1_gal.php');
}

?>
</body>
</html>
