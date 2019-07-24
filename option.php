<?php
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
  <div id="insert" class="option">
    <button>
      <a href="./insertBox.php">
        <h4>Insert</h4>
      </a>
    </button>
  </div>
  <div id="showDB" class="option">
    <button>
      <a href="./showAllBox.php">
        <h4>Show DB</h4>
      </a>
    </button>
  </div>
</div>
<?php
require_once "./js_php.php";
?>
</body>

</html>