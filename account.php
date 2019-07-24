<?php
class user
{
  private $query = "SELECT * FROM USER";
  private $res;
  public function __construct()
  {
    $this->res = mysqli_query($GLOBALS['conn'], $this->query) or die("Cant select from db!");
  }
  public function checkUserName($username)
  {
    $pattern = "#^[a-zA-Z0-9_\.\s]{4,31}$#"; // str = a-z || 0-9 || . || _ || space, from 4+1 - 31+1 chars
    $flag = false;
    if (preg_match($pattern, $username)) {
      $flag = true;
    }
    return $flag;
  }
  public function checkPassword($password)
  {
    $pattern = "#^(?=.*\d)(?=.*[A-Z]).{4,12}$#"; // str exist at least 1 of 0-9 && A-Z && _, from 4+1 - 11+1 chars
    $flag = false;
    if (preg_match($pattern, $password)) {
      $flag = true;
    }
    return $flag;
  }
  public function logIn()
  {
    if (isset($_POST['logIn'])) {
      if (!$this->checkUserName($_POST["user"]) || !$this->checkPassword($_POST["password"])) {
        $msg = "<span class='text-warning'><br />Password or Username is not valid!<br />Username must be str += . | _ | space, 5-32 chars
  <br />Password must be str exist at least 1 of 0-9 & A-Z, 5-12 chars</span>";
        setcookie("msgLogIn", $msg, time() + 1, "/");
        header("location: ./index.php");
        return;
      }
      $found = false;
      $exist = false;
      if (mysqli_num_rows($this->res)) {
        for ($i = 1; $col = mysqli_fetch_assoc($this->res); $i++) {
          if ($_POST["user"] == $col["user"]) {
            $exist = true;
            if ($_POST["password"] == $col["password"]) {
              $found = true;
              break;
            }
          }
        }
      }
      if ($found) {
        setcookie("user", $_POST["user"], time() + 3600, "/");
        setcookie("password", $_POST["password"], time() + 3600, "/");
        header("location: ./option.php");
      } else {
        if ($exist) {
          $msg = "Wrong Password!";
        } else {
          $msg = "Unexisted Account!";
        }
        setcookie("msgLogIn", $msg, time() + 1, "/");
        header("location: ./index.php");
      }
    }
  }
  public function signUp()
  {
    if (isset($_POST['signUp'])) {
      if (!$this->checkUserName($_POST["user"]) || !$this->checkPassword($_POST["password"])) {
        $msg = "<span class='text-warning'><br />Password or Username is not valid!<br />Username must be str += . | _ | space, 5-32 chars
  <br />Password must be str exist at least 1 of 0-9 & A-Z, 5-12 chars</span>";
        setcookie("msgSignUp", $msg, time() + 1, "/");
        header("location: ./index.php");
        return;
      }
      if ($_POST['password'] != $_POST['repassword']) {
        $msg = "Password and RePassword aint the same!";
        setcookie("msgSignUp", $msg, time() + 1, "/");
        header("location: ./index.php");
        return;
      }
      $found = false;
      if (mysqli_num_rows($this->res)) {
        for ($i = 1; $col = mysqli_fetch_assoc($this->res); $i++) {
          if ($_POST["user"] == $col["user"]) {
            $found = true;
            break;
          }
        }
      }
      if (!$found) {
        $query = "INSERT INTO USER VALUES ('" . $_POST["user"] . "', '" . $_POST["password"] . "')";
        mysqli_query($GLOBALS['conn'], $query) or die("Cant select from db!");
        $msg = "Add Done!";
        setcookie("msgSignUp", $msg, time() + 1, "/");
        header("location: ./index.php");
      } else {
        $msg = "Existed Account!";
        setcookie("msgSignUp", $msg, time() + 1, "/");
        header("location: ./index.php");
      }
    }
  }
}
