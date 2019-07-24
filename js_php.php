<script>
  <?php
  if (isset($_COOKIE["msgLogIn"])) {
    echo "$('.logInCard').show();
    $('#background').css({
    'filter': 'sepia(120%)'
    });
    $('.rest').show();";
  }
  ?>
  <?php
  if (isset($_COOKIE["msgSignUp"])) {
    echo "$('.signUpCard').show();
    $('#background').css({
    'filter': 'sepia(120%)'});
    $('.rest').show();";
  }
  ?>
  <?php
  class finding
  {
    private $id;
    private $name;
    private $genre;
    private $image;
    private $type;
    private $status;
    private $description;

    function search()
    {
      if (isset($_POST["search"])) {
        $query = "SELECT ID, GENRE.NAME, GENRE, IMAGE, TYPE, STATUS, DESCRIPTION FROM ANIME JOIN GENRE ON ANIME.NAME = GENRE.NAME WHERE ";
        if (strlen($_POST['id'])) {
          $query .= "ID = " . $_POST['id'];
        } else {
          if (isset($_POST['name'])) {
            $query .= "GENRE.NAME LIKE '%" . $_POST['name'] . "%'";
          }
          if (isset($_POST['genre'])) {
            $query .= " AND GENRE LIKE '%" . $_POST['genre'] . "%'";
          }
        }
        $query .= " ORDER BY ID";
        $res = mysqli_query($GLOBALS['conn'], $query) or die("Cant find anime in db!");
        if (mysqli_num_rows($res)) {
          for ($index = 0; $col = mysqli_fetch_assoc($res); $index++) {
            if ($index == 0) {
              $this->id[$index] = $col['ID'];
              $this->name[$index] = $col['NAME'];
              $this->genre[$index] = $col['GENRE'];
              $this->image[$index] = $col['IMAGE'];
              $this->type[$index] = $col['TYPE'];
              $this->status[$index] = $col['STATUS'];
              $this->description[$index] = $col['DESCRIPTION'];
            } else {
              $diff = true;
              for ($i = 0; $i < count($this->id); $i++) {
                if ($col['ID'] == $this->id[$i]) {
                  $this->genre[$i] .= ", " . $col['GENRE'];
                  $diff = false;
                  $index--;
                  break;
                }
              }
              if ($diff) {
                $this->id[$index] = $col['ID'];
                $this->name[$index] = $col['NAME'];
                $this->genre[$index] = $col['GENRE'];
                $this->image[$index] = $col['IMAGE'];
                $this->type[$index] = $col['TYPE'];
                $this->status[$index] = $col['STATUS'];
                $this->description[$index] = $col['DESCRIPTION'];
              }
            }
          }
        }
        $NoPage = ceil((count($this->id)) / 9);
        echo "if($NoPage > 1){
        $('.tableAnime').prepend(`
        <thead><tr><th scope='col' colspan='7'><div class='pageNum text-center' id='topPageNum'>
        <button class='pre rounded-left'><i class='fas fa-angle-left'></i></button></div>`);
        for(var pageNum=1; pageNum<=$NoPage; pageNum++){
          $('.tableAnime #topPageNum').append(`<button class='pageN pageN`+ (pageNum-1) +`'>`+ pageNum +`</button>`);
        }
        $('.tableAnime #topPageNum').append(`<button class='next rounded-right'><i class='fas fa-angle-right'></i></button>
        </th></tr></thead>`);
      }";
        for ($i = 0; $i < $NoPage; $i++) {
          echo "$('.tableAnime').append(`<tbody class='animePage' id='animePage`+ $i +`'></tbody>`);";
          if ($NoPage == $i + 1) {
            for ($j = $i * 9; $j < count($this->id); $j++) {
              echo "$('.tableAnime #animePage' + $i).append(`
            <tr>
              <td>" . $this->id[$j] . "</td>
              <td colspan='3'>" . $this->name[$j] . "</td>
              <td>" . $this->type[$j] . "</td>
              <td>" . $this->status[$j] . "</td>
              <td>
                <button class='rounded-pill bg-warning b-0 animeInfo'>More</button>
              </td>
            </tr>
            `);";
            }
          } else {
            for ($j = $i * 9; $j < ($i + 1) * 9; $j++) {
              echo "$('.tableAnime #animePage' + $i).append(`
            <tr>
              <td>" . $this->id[$j] . "</td>
              <td colspan='3'>" . $this->name[$j] . "</td>
              <td>" . $this->type[$j] . "</td>
              <td>" . $this->status[$j] . "</td>
              <td>
                <button class='rounded-pill bg-warning b-0 animeInfo'>More</button>
              </td>
            </tr>
            `);";
            }
          }
        }
        echo "$('#animePage0').addClass('pageActive');";
        echo "$('.pageN0').addClass('numPageActive');";
      }
    }
    function animeInfo()
    {
      echo "$('.animeInfoCard').empty();
      $('.animeInfoCard').show();
      $('#background').css({
        'filter': 'sepia(120%)'
      });
      $('.rest').show();";
      for ($i = 0; $i < count($this->id); $i++) {
        echo "if(Number($(this).parent().siblings(':first').text()) === Number('" . $this->id[$i] . "')){
          $('.animeInfoCard').append(
            `<div class='row no-gutters' style='background: azure;'>
                <div class='col-md-4 p-2'>
                    <img src='" . $this->image[$i] . "' class='card-img imgData' alt='" . $this->name[$i] . "'>
                </div>
                <div class='col-md-8'>
                    <div class='card-body'>
                        <h4 class='card-title'>" . $this->name[$i] . "</h4>
                        <p class='card-text'><b>Type:</b> " . $this->type[$i] . "</p>
                        <p class='card-text'><b>Status:</b> " . $this->status[$i] . "</p>
                        <p class='card-text'><b>Genre:</b> " . $this->genre[$i] . "</p>
                        <p class='card-text' style=' max-height: 300px; overflow-y: auto;'><b>Description:</b> " . $this->description[$i] . "</p>
                    </div>
                </div>
            </div>`
          );
        }";
      }
    }
  }
  $findAnime = new finding;
  $findAnime->search();
  ?>
  $("body").on("click", ".animeInfo", function() {
    console.log($(this).parent().siblings(':first').text());
    <?php echo $findAnime->animeInfo(); ?>
  });
</script>