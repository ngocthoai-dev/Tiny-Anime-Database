$(document).ready(function () {
  $("#logIn").click(function () {
    $(".logInCard").show();
    $("#background").css({
      "filter": "sepia(120%)"
    });
    $(".rest").show();
  });
  $("#signUp").click(function () {
    $(".signUpCard").show();
    $("#background").css({
      "filter": "sepia(120%)"
    });
    $(".rest").show();
  });
  $(".rest").click(function () {
    $(".logInCard").hide();
    $(".signUpCard").hide();
    $("#background").css({
      "filter": "sepia(50%)"
    });
    $('.animeInfoCard').hide();
    $(".rest").hide();
  });
  $("#logOut").click(function () {
    location.replace("./logOut.php");
  });
  $("#return").click(function () {
    location.replace("./option.php");
  });
  var currentPage = 0;
  $(".tableAnime").on("click", ".pageNum .next", function () {
    $(".animePage").removeClass("pageActive");
    if (currentPage == $(".pageN").last().index() - 1) {
      currentPage = 0;
    }
    else {
      currentPage++;
    }
    $(".pageN").removeClass("numPageActive");
    $(".pageN" + currentPage).addClass("numPageActive");
    $("#animePage" + currentPage).addClass("pageActive");
  });
  $(".tableAnime").on("click", ".pageNum .pre", function () {
    $(".animePage").removeClass("pageActive");
    if (currentPage == 0) {
      currentPage = $(".pageN").last().index() - 1;
    }
    else {
      currentPage--;
    }
    $(".pageN").removeClass("numPageActive");
    $(".pageN" + currentPage).addClass("numPageActive");
    $("#animePage" + currentPage).addClass("pageActive");
  });
  $(".tableAnime").on("click", ".pageN", function () {
    $(".pageN").removeClass("numPageActive");
    currentPage = $(this).index() - 1;
    $(".pageN" + currentPage).addClass("numPageActive");
    $(".animePage").removeClass("pageActive");
    $("#animePage" + currentPage).addClass("pageActive");
  });
});