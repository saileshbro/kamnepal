var count = 1;
var string1 = "";
val1;
val2;
val3;

function toggleDropdown() {
  $(".dropdown").slideToggle("show");
}

function toggleDropdownProf() {
  $("#Prof-drop").slideToggle("show");
}

function toggleRegistration() {
  let element = document.querySelectorAll("#drop-nav");
  let element2 = document.querySelectorAll(".drop-active");
  for (let i = 0; i < element.length; i++) {
    element[i].classList.toggle("active");
  }
  for (let i = 0; i < element2.length; i++) {
    element2[i].classList.toggle("show");
  }
}
$(".remedu").click(function (event) {
  var str = event.target.id;
  var eduId = str.slice(4, str.length); //equals 14
  $(".edu-" + eduId).remove();
  $.ajax({
    type: "POST",
    url: "posts/process.php",
    data: {
      eduId: eduId
    },
    success: data => {}
  });
});

window.pressed = function () {
  var a = document.getElementById("aa");
  if (a.value == "") {
    fileLabel.innerHTML = "Choose a passport sized photo";
  } else {
    var theSplit = a.value.split("\\");
    fileLabel.innerHTML = theSplit[theSplit.length - 1];
  }
};

function removeEduPressed(data) {
  let parent = $("#" + data).parent()[0].classList[1];
  let mainParent = parent;
  parent = "." + parent + " :input";
  var myData = $(parent).serialize();
  console.log(myData);

  $.ajax({
    type: "POST",
    url: "../profile/posts/process.php",
    data: myData,
    success: function (data) {
      if (data == "success") {
        alert("edu");
        // success message here
      } else {
        //   error message here
      }
    }
  });
  $("." + mainParent).remove();
  val1--;
}

function removeExpPressed(data) {
  //   console.log(data);
  let parent = $("#" + data).parent()[0].classList[1];
  console.log(parent);
  let mainParent = parent;
  parent = "." + parent + " :input";
  var myData = $(parent).serialize();
  console.log(myData);

  $.ajax({
    type: "POST",
    url: "../profile/posts/process.php",
    data: myData,
    success: function (data) {
      if (data == "success") {
        alert("emp");
        // success message here
      } else {
        //   error message here
      }
    }
  });
  $("." + mainParent).remove();
  val2--;
}

function removeSkillPressed(data) {
  let parent = $("#" + data).parent()[0].classList[1];
  console.log(parent);
  let mainParent = parent;
  parent = "." + parent + " :input";
  var myData = $(parent).serialize();
  console.log(myData);

  $.ajax({
    type: "POST",
    url: "../profile/posts/process.php",
    data: myData,
    success: function (data) {
      if (data == "success") {
        alert("skill");
        // success message here
      } else {
        //   error message here
      }
    }
  });
  $("." + mainParent).remove();
  val3--;
}
$(document).ready(() => {
  $(".scroll").click(function (e) {
    e.preventDefault();

    var position = $($(this).attr("href")).offset().top;

    $("body, html").animate({
      scrollTop: position
    });
  });
  $("#footer-home").click(function (e) {
    e.preventDefault();

    var position = $($(this).attr("href")).offset().top;

    $("body, html").animate({
      scrollTop: position
    });
  });
  $("#footerContact").click(() => {
    $("#focusField").focus();
    $("#inputGr")
      .addClass("inputOutline")
      .delay(2000)
      .queue(function (next) {
        $(this).removeClass("inputOutline");
        next();
      });
  });
  $("#addEducation").click(() => {
    $("#education").append(
      "<div class='cvform education-" +
      val1 +
      "'><input type='text' name='course-title-" +
      val1 +
      "' placeholder='Your course name'><input type='text' name='course-inst-" +
      val1 +
      "' placeholder='Your Institution&apos;s name'><input type='text' name='course-begin-" +
      val1 +
      "' placeholder='Course start year'><input type='text' name='course-end-" +
      val1 +
      "' placeholder='Course ended. Blank for present'><textarea name='course-detail-" +
      val1 +
      "' id='' cols='30' rows='10' placeholder='Add your course Details'></textarea><a onclick='removeEduPressed(this.id);' href='javascript:;'class='links remedu'id='edu-" +
      val1 +
      "' >Remove</a></div>"
    );
    val1++;
  });
  $("#addExperience").click(() => {
    $("#experience").append(
      "<div class='cvform experience-" +
      val2 +
      "'><input type='text' name='emp-title-" +
      val2 +
      "' placeholder='Job title | Designation'><input type='text' name='emp-comp-" +
      val2 +
      "' placeholder='Add the company&apos;s name.'><input type='text' name='emp-begin-" +
      val2 +
      "' placeholder='Start year'><input type='text' name='emp-end-" +
      val2 +
      "' placeholder='End Year | Blank for Current'><textarea name='emp-detail-" +
      val2 +
      "' id='' cols='30' rows='10' placeholder='Explain your role'></textarea><a href='javascript:;' onclick='removeExpPressed(this.id);' class='links remexp' id='emp-" +
      val2 +
      "' >Remove</a></div>"
    );
    val2++;
  });
  $("#addSkill").click(() => {
    $(".skill-group").append(
      "<div id='skill-set'><div class='skillinp skills-" +
      val3 +
      "'><div class='inpgrp'><input class='skills' name='skill-type-" +
      val3 +
      "' class='input1' placeholder='Add skill type. Eg. Language'><input class='skills' name='skill-list-" +
      val3 +
      "' class='input1' placeholder='Add skills. Eg. English, French, Spanish'></div><a href='javascript:;' onclick='removeSkillPressed(this.id);' class='links remexp' id='emp-" +
      val3 +
      "' >Remove</a></div></div>"
    );
    val3++;
  });

  // dashboard

  $(".jobPosts").bind(
    "click",
    $.proxy(function (event) {
      var postId = $(event.target).attr("id");
      $.ajax({
        url: "../modal.php",
        method: "post",
        data: {
          postId: postId
        },
        success: function (data) {
          $("#modal").html(data);
          $(".modal").fadeIn();
        }
      });
    }, this)
  );
  $("#dob").datepicker({
    changeYear: true,
    changeMonth: true,
    yearRange: "1950:2000"
  });
  $(document).keyup(function (e) {
    if (e.keyCode === 27) $(".modal-title").click();
  });
  $(".landing-search input").focus(() => {
    $(".landing-search").css("top", "25%");
  });
  $(".landing-search input").blur(() => {
    $(".landing-search").css("top", "50%");
  });
});