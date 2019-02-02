var val1 = 0;
var val2 = 0;
var val3 = 0;
var count = 1;
var string1 = "";
$(document).ready(() => {
    // date picker
    $("#dob").datepicker({
        changeYear: true,
        changeMonth: true,
        yearRange: "1950:2000",

    });
    // add education
    $('#addEducation').click(() => {
        $('#education').append("<div class='cvform edu-" + val1 + "'><input type='text' name='course-title-" + val1 + "' placeholder='Your course name'><input type='text' name='course-inst-" + val1 + "' placeholder='Your Institution&apos;s name'><input type='text' name='course-begin-" + val1 + "' placeholder='Course start year'><input type='text' name='course-end-" + val1 + "' placeholder='Course ended. Blank for present'><textarea name='course-detail-" + val1 + "' id='' cols='30' rows='10' placeholder='Add your course Details'></textarea><a href='javascript:;' onclick='removeEduPressed(this.parentElement);' class='links remedu" + val1 + "' >Remove</a></div>");
        val1++;
    });
    // add experience
    $('#addExperience').click(() => {
        $('#experience').append("<div class='cvform exp-" + val2 + "'><input type='text' name='emp-title-" + val2 + "' placeholder='Job title | Designation'><input type='text' name='emp-comp-" + val2 + "' placeholder='Add the company&apos;s name.'><input type='text' name='emp-begin-" + val2 + "' placeholder='Start year'><input type='text' name='emp-end-" + val2 + "' placeholder='End Year | Blank for Current'><textarea name='emp-detail-" + val2 + "' id='' cols='30' rows='10' placeholder='Explain your role'></textarea><a href='javascript:;' onclick='removeExpPressed(this.parentElement);' class='links remexp" + val2 + "' >Remove</a></div>");
        val2++;
    });
    // add skilll
    $('#addSkill').click(() => {
        $('#skill-set').append("<div class='skillinp skills-" + val3 + "'><div class='inpgrp'><input name='skill-type-" + val3 + "' class='input1' placeholder='Add skill type. Eg. Language'><input name='skill-list-" + val3 + "' class='input1' placeholder='Add skills. Eg. English, French, Spanish'></div><a href='javascript:;' onclick='removeSkillPressed(this.parentElement);' class='links remskill" + val3 + "' >Remove</a></div></div>");
        val3++;
    });
    // file upload from id click
    var readURL = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#avatar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".file-upload").on('change', function () {
        readURL(this);
    });
    $(".upload-button").on('click', function () {
        $(".file-upload").click();
    });
});