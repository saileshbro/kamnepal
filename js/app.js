var val1;
var val2;
var val3;
var user_id;
var email;
var fcode;



// ******************* PROFILE *********************************
// fade modal when changing password from profile
function changePass() {
  $("#modal").fadeIn();
}
// change password from profile page
function newPass() {
  //get fields
  var formData = $("#resetForm").serialize();
  formData = formData + "&user_id=" + user_id;
  $("#error").html(
    '<img src="/img/gif/loading.gif" alt="" srcset="" style="width:72px;">'
  );
  // send request to server
  $.ajax({
    url: "../../login/posts/password-reset.php",
    data: formData,
    type: "POST",
    success: data => {
      $("#error").html(data);
      if (data === "Password changed sucessfully.") {
        $("input").removeAttr("required");
        $("input")
          .delay(200)
          .val("");
        $(".modal")
          .delay(700)
          .fadeOut();
      }
    }
  });
}
//edit and delete posts from profile
function removePost(mydata) {
  var id = mydata.slice(5, mydata.length);
  $.ajax({
    url: "../postRemove.php",
    type: "POST",
    data: {
      id: mydata
    },
    success: function (data) {
      alert(data);
    }
  });
  $("#job" + id).fadeOut();
  var num = $("#num-post-org").text() - 1;
  $("#num-post-org").text(num);
}
// delete button display peofile
function displayedit(mydata) {
  var id = mydata.slice(6, mydata.length);
  $("#delete" + id).hide();
  $("#check" + id).fadeIn();
  $("#check" + id).mouseout(function () {
    setTimeout(() => {
      $("#check" + id).hide();
      $("#delete" + id).fadeIn();
    }, 1500);
  });
}
// display and edit post from profile
function editPost(mydata) {
  mydata = mydata.slice(4, mydata.length);
  $.ajax({
    url: "../modal-post.php",
    type: "POST",
    data: {
      editId: mydata
    },
    success: function (data) {
      $(".inp-grp").attr("id", mydata);
      if (JSON.parse(data).type === "Jobseeker") {
        $("#title").val(JSON.parse(data).title);
        createpost.setData(JSON.parse(data).body);
      } else {
        $("#title").val(JSON.parse(data).title);
        createpost.setData(JSON.parse(data).body);
        document.getElementById("category").value = JSON.parse(data).category;
      }
      $(".modal-post-form").fadeIn();
    }
  });
}
// update post ajax call
$(".modal-post-form #create-button").click(() => {
  var title = document.getElementById("title").value;
  var category = $("#createPost select").val();
  var fileToUpload = $("#file").prop("files")[0];
  var postId = $(".inp-grp").attr("id");
  var body = createpost.getData();
  var form = new FormData();
  form.append("user_id", user_id);
  form.append("title", title);
  form.append("body", body);
  form.append("category", category);
  form.append("image", fileToUpload);
  form.append("postId", postId);
  $.ajax({
    type: "POST",
    url: "../../updatepost.php",
    contentType: false,
    processData: false,
    data: form,
    success: data => {
      $(".modal-post-form").fadeOut();
      $("a#" + postId + ".links.jobPosts").html(title);
      $("#job" + postId + " .job-body p").html(body);
    }
  });
});



// *******************LANDING***********************
function searchLanding(data) {
  if (data === "") {
    $(".searches").hide();
  } else {
    $(".searches").show();
    $.ajax({
      url: "/search.php",
      type: "POST",
      data: {
        data: data
      },
      success: data => {
        $("#search-list").html(data);
      }
    });
  }
}
// search input up************
$(".search-elements input").focus(() => {
  $(".search-elements").animate({
      height: "600px"
    },
    500
  );
});
// langing page scroll on click
$(".scroll").click(function (e) {
  e.preventDefault();
  var position = $($(this).attr("href")).offset().top;

  $("body, html").animate({
    scrollTop: position
  });
});



// ******************DROPDOWNS*************************
function toggleDropdown() {
  $(".dropdown").slideToggle("show");
}

function toggleDropdownProf() {
  $("#Prof-drop").slideToggle("show");
}

function toggleNotice() {
  $('#noticeDrop').slideToggle('Show');
  $('i').removeClass('notice');
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
window.pressed = function () {
  var a = document.getElementById("aa");
  if (a.value == "") {
    fileLabel.innerHTML = "Choose a passport sized photo";
  } else {
    var theSplit = a.value.split("\\");
    fileLabel.innerHTML = theSplit[theSplit.length - 1];
  }
};



// ************************** PROFILE UPDATE****************************************************************************
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
//remove education Jobseeker profile update
function removeEduPressed(data) {
  let parent = $("#" + data).parent()[0].classList[1];
  let mainParent = parent;
  parent = "." + parent + " :input";
  var myData = $(parent).serialize();
  $("#error").html(
    '<img src="/img/gif/loading.gif" alt="" srcset="" style="width:72px;">'
  );
  $.ajax({
    type: "POST",
    url: "../jsk/posts/processRemove.php",
    data: myData,
    success: function (data) {
      $("#error").html(data);
    }
  });
  $("." + mainParent).remove();
  val1--;
}
// remove experience
function removeExpPressed(data) {
  let parent = $("#" + data).parent()[0].classList[1];
  let mainParent = parent;
  parent = "." + parent + " :input";
  var myData = $(parent).serialize();
  $("#error").html(
    '<img src="/img/gif/loading.gif" alt="" srcset="" style="width:72px;">'
  );
  $.ajax({
    type: "POST",
    url: "../jsk/posts/processRemove.php",
    data: myData,
    success: function (data) {
      $("#error").html(data);
    }
  });
  $("." + mainParent).remove();
  val2--;
}
// remove skills
function removeSkillPressed(data) {
  let parent = $("#" + data).parent()[0].classList[1];
  let mainParent = parent;
  parent = "." + parent + " :input";
  var myData = $(parent).serialize();
  $("#error").html(
    '<img src="/img/gif/loading.gif" alt="" srcset="" style="width:72px;">'
  );
  $.ajax({
    type: "POST",
    url: "../jsk/posts/processRemove.php",
    data: myData,
    success: function (data) {
      $("#error").html(data);
    }
  });
  $("." + mainParent).remove();
  val3--;
}

//update jobseeker profile
$("#updateJsk").click(() => {
  var dataSet = $(".profileUpdate :input").serialize();
  $("#error").html(
    '<img src="/img/gif/loading.gif" alt="" srcset="" style="width:72px;">'
  );
  $.ajax({
    url: "../jsk/posts/processUpdate.php",
    type: "POST",
    data: dataSet,
    success: data => {
      $("#error").html(data);
      location.href = "display.php?user_id=" + data;
    }
  });
});
// update employer profile
$("#updateEmp").click(() => {
  var dataSet = $(".profileUpdate :input").serialize();
  $("#error").html(
    '<img src="/img/gif/loading.gif" alt="" srcset="" style="width:72px;">'
  );
  $.ajax({
    url: "../emp/posts/processUpdate.php",
    type: "POST",
    data: dataSet,
    success: data => {
      $("#error").html(data);
      location.href = "display.php?user_id=" + data;
    }
  });
});
// profile update pic codes
var readURL = function (input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $("#avatar").attr("src", e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
};
$(".file-upload").on("change", function () {
  readURL(this);
});
$(".upload-button").on("click", function () {
  $(".file-upload").click();
});

// print jobseeker cv window open
$("#printCV").click(() => {
  window.open("../cv.php?user_id=" + user_id);
});
// switch about and timeline
$("#timeline").click(function () {
  $("#about-right").hide();
  $("#timeline-right").show();
  $(".prof-head-gender,.prof-head-interest,.message").hide();
  $("#about").removeClass("when");
  $("#timeline").addClass("when");
});
// switch about and timeline
$("#about").click(function () {
  $("#timeline-right").hide();
  $(".prof-head-gender,.prof-head-interest,.message").show();
  $("#about-right").show();
  $("#about").addClass("when");
  $("#timeline").removeClass("when");
});




//*******************FOOTER******************************************/
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



//****************************************DASHBOARD*****************************************/
$("#title").click(() => {
  if ($("#title").val() == "") {
    $("#cke_editor").fadeIn();
  }
});

$(document).mouseup(function (e) {
  var container = $("#Prof-drop,div.dropdown,#noticeDrop");
  if (!container.is(e.target) && container.has(e.target).length === 0) {
    container.fadeOut();
  }
});
$(document).mouseup(function (e) {
  var container = $(".search-elements");
  if (!container.is(e.target) && container.has(e.target).length === 0) {
    container.css("height", "");
  }
});




//*************************MODALS****************************
$("#mod-title").click(function () {
  $("#modal").fadeOut();
});

$("#education-more").click(function () {
  $("#modal-profile-1").fadeIn();
});

$("#experience-more").click(function () {
  $("#modal-profile-2").fadeIn();
});

$("#edu-modal-head").click(function () {
  $("#modal-profile-1").fadeOut();
});

$("#exp-modal-head").click(function () {
  $("#modal-profile-2").fadeOut();
});



// *************************FORGOT PASSWORD*********************
$("#forgotPassword").click(() => {
  $(".modal-forgot").fadeIn();
});



// ******date picker****************
$("#dob").datepicker({
  changeYear: true,
  changeMonth: true,
  yearRange: "1950:2000"
});
// esc key map**************************
$(document).keyup(function (e) {
  if (e.keyCode === 27) {
    $(".modal-title").click();
    $("#edu-modal-head").click();
    $("#exp-modal-head").click();
    $(".modal").fadeOut();
  }
});
getNotice();