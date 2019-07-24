<?php
$conn = new mysqli("localhost", "animeDB", "animeDatabase", "animedb") or die("Cant connect database!");
mysqli_query($conn, "set names utf8");
if (!isset($_COOKIE["user"]) || !isset($_COOKIE["password"])) {
  header("location: ./index.php");
}
?>
<?php
require "./top.php";
require "./barOption.php";
?>
</div>
<div id="pageContent" class="row mx-0">
  <div class="table-responsive-md">
    <table class="table table-dark">
      <form method="post">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Type</th>
            <th scope="col">Genre</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <?php
              $query = "SELECT COUNT(ID) FROM ANIME";
              $res = mysqli_query($GLOBALS['conn'], $query) or die("Cant select from db!");
              if (mysqli_num_rows($res)) {
                $count = mysqli_fetch_assoc($res);
              }
              $id = $count["COUNT(ID)"] + 1;
              echo $id;
              ?>
            </td>
            <td><input type="text" name="name" value="<?php if (isset($_POST["insert"])) if (isset($_POST['name'])) {
                                                        echo htmlspecialchars($_POST['name']);
                                                      } ?>" /></td>
            <td><input type="text" name="type" value="<?php if (isset($_POST["insert"])) if (isset($_POST['type'])) {
                                                        echo htmlspecialchars($_POST['type']);
                                                      } ?>" /></td>
            <td colspan="2"><textarea rows="4" cols="50" name="genre"><?php if (isset($_POST["insert"])) if (isset($_POST['genre'])) {
                                                                        echo htmlspecialchars($_POST['genre']);
                                                                      } ?></textarea></td>
          </tr>
          <tr class="text-center">
            <td colspan="7" id="bulletBox">
              <img src="https://cdn.pixabay.com/photo/2013/07/12/16/25/katana-150859__340.png" alt="bullet" id="bullet1" />
              <img src="https://cdn.pixabay.com/photo/2013/07/12/16/25/katana-150859__340.png" alt="bullet" id="bullet2" />
              <input type="submit" name="insert" value="insert" class="w-75 insert" />
            </td>
          </tr>
        </tbody>
        <thead>
          <th scope="col">Status</th>
          <th scope="col" colspan="2">Image</th>
          <th scope="col" colspan="2">Description</th>
        </thead>
        <tr>
          <td><input type="text" name="status" value="<?php if (isset($_POST["insert"])) if (isset($_POST['status'])) {
                                                        echo htmlspecialchars($_POST['status']);
                                                      } ?>" /></td>
          <td colspan="2"><input type="text" class="w-100" name="image" value="<?php if (isset($_POST["insert"])) if (isset($_POST['image'])) {
                                                                                  echo htmlspecialchars($_POST['image']);
                                                                                } ?>" /></td>
          <td colspan="2"><textarea rows="4" cols="50" name="description"></textarea></td>
        </tr>
      </form>
    </table>
  </div>
</div>
</div>
<?php
insert();
function insert()
{
  if (isset($_POST["insert"])) {
    if (strlen($_POST["name"]) != 0) {
      $tempGenre = $_POST["genre"];
      for ($i = 0;; $i++) {
        if (!strpos($tempGenre, ",")) {
          $genre[$i] = $tempGenre;
          break;
        } else {
          $genre[$i] = substr($tempGenre, 0, strpos($tempGenre, ","));
          $tempGenre = substr($tempGenre, strpos($tempGenre, ",") + 2, strlen($tempGenre) - strpos($tempGenre, ",") - 2);
        }
      }
      $_POST['name'] = str_replace("'", "\'", $_POST['name']);
      $_POST['description'] = str_replace("'", "\'", $_POST['description']);
      $query = "SELECT NAME, GENRE FROM GENRE WHERE NAME = '" . $_POST['name'] . "'";
      $res = mysqli_query($GLOBALS['conn'], $query) or die("Cant find anime in db!");
      if (mysqli_num_rows($res)) {
        $max = count($genre);
        for ($i = 0; $i < $max; $i++) {
          while ($col = mysqli_fetch_assoc($res)) {
            if ($col["GENRE"] == $genre[$i]) {
              array_splice($genre, $i, 1);
              $i--;
              break;
            }
          }
        }
      }
      $query = "SELECT NAME FROM ANIME WHERE NAME = '" . $_POST['name'] . "'";
      $res = mysqli_query($GLOBALS['conn'], $query) or die("Cant find anime in db!");
      if (!mysqli_num_rows($res)) {
        $query = "INSERT INTO ANIME VALUES(" . $GLOBALS['id'] . ", '" . $_POST['name'] . "', '" . $_POST['image'] . "', '" . $_POST['type'] . "', '" . $_POST['status'] . "', '" . $_POST['description'] . "')";
        mysqli_query($GLOBALS['conn'], $query) or die("Cant insert to db!");
      }
      for ($j = 0; $j < count($genre); $j++) {
        $query = "INSERT INTO GENRE VALUES('" . $_POST['name'] . "', '" . $genre[$j] . "')";
        mysqli_query($GLOBALS['conn'], $query) or die("Cant insert to db!");
      }
      header("location: ./insertBox.php");
    } else {
      echo "<script>alert('name should not be empty')</script>";
    }
  }
}
?>
<?php
require_once "./js_php.php";
?>
</body>

</html>