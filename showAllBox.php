<?php
$conn = new mysqli("localhost", "animeDB", "animeDatabase", "animedb") or die("Cant connect database!");
mysqli_query($conn, "set names utf8");
if (!isset($_COOKIE["user"]) || !isset($_COOKIE["password"])) {
  header("location: ./logIn_signUp.php");
}
?>
<?php
require "./top.php";
require "./barOption.php";
?>
</div>
<div id="pageContent" class="row mx-0">
  <div class="table-responsive-md col-12 col-lg-6">
    <table class="table table-dark">
      <form method="post">
        <thead>
          <tr>
            <th scope="col">ID*</th>
            <th scope="col">Name</th>
            <th scope="col">Genre</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="text" name="id" value="<?php if (isset($_POST['id'])) {
                                                      echo htmlspecialchars($_POST['name']);
                                                    } ?>" /></td>
            <td><input type="text" name="name" value="<?php if (isset($_POST['name'])) {
                                                        echo htmlspecialchars($_POST['name']);
                                                      } ?>" /></td>
            <td><input type="text" name="genre" value="<?php if (isset($_POST['genre'])) {
                                                          echo htmlspecialchars($_POST['genre']);
                                                        } ?>" /></td>
          </tr>
          <tr class="text-center">
            <td colspan="3" id="bulletBox">
              <img src="https://cdn.pixabay.com/photo/2013/07/12/16/25/katana-150859__340.png" alt="bullet" id="bullet1" />
              <img src="https://cdn.pixabay.com/photo/2013/07/12/16/25/katana-150859__340.png" alt="bullet" id="bullet2" />
              <input type="submit" name="search" value="search" class="w-75" />
            </td>
          </tr>
        </tbody>
      </form>
    </table>
  </div>

  <div class="table-responsive-md col-12 col-lg-8">
    <table class="table table-dark tableAnime">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col" colspan="3">Name</th>
          <th scope="col">Type</th>
          <th scope="col">Status</th>
          <th scope="col">More Info</th>
        </tr>
      </thead>

    </table>
  </div>
</div>
<div class="rest position-absolute w-100 h-100"></div>
<div class="animeInfoCard card">

</div>
</div>
<?php
require_once "./js_php.php";
?>
</body>

</html>