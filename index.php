<?php
$conn = new mysqli("localhost", "animeDB", "animeDatabase", "animedb") or die("Cant connect database!");
mysqli_query($conn, "set names utf8");
require "./account.php";
$account = new user();
if (isset($_COOKIE["user"]) && isset($_COOKIE["password"])) {
  header("location: ./option.php");
}
?>
<?php
require "./top.php";
?>
</div>
<div id="pageContent" class="row mx-0">
  <div id="logIn" class="option">
    <button>
      <h4>Log In</h4>
    </button>
  </div>
  <div id="signUp" class="option">
    <button>
      <h4>Sign Up</h4>
    </button>
  </div>
</div>
<div class="logIn_signUpCard logInCard card">
  <form method="post" class="card-body">
    <div class="card-text d-flex justify-content-between"><label class="m-0 mr-2">User: </label><input type="text" name="user"></div><br />
    <div class="card-text d-flex justify-content-between"><label class="m-0 mr-2">Password: </label><input type="password" name="password"></div>
    <hr />
    <input type="submit" name="logIn" class="btn btn-primary" value="Log In">
    <?php
    $account->logIn();
    ?>
    <?php
    if (isset($_COOKIE["msgLogIn"])) {
      echo $_COOKIE["msgLogIn"];
    }
    ?>
  </form>
</div>
<div class="logIn_signUpCard signUpCard card">
  <form method="post" class="card-body">
    <div class="card-text d-flex justify-content-between"><label class="m-0 mr-2">User: </label><input type="text" name="user"></div><br />
    <div class="card-text d-flex justify-content-between"><label class="m-0 mr-2">Password: </label><input type="password" name="password"></div><br />
    <div class="card-text d-flex justify-content-between"><label class="m-0 mr-2">Reenter Password: </label><input type="password" name="repassword"></div>
    <hr />
    <input type="submit" name="signUp" class="btn btn-primary" value="Sign Up">
    <?php
    $account->signUp();
    ?>
    <?php
    if (isset($_COOKIE["msgSignUp"])) {
      echo $_COOKIE["msgSignUp"];
    }
    ?>
  </form>
</div>
<div class="rest position-absolute w-100 h-100"></div>
</div>
<?php
require "./js_php.php";
?>
</body>

</html>