var val1 = 0;
var val2 = 0;
var val3 = 0;
var count = 1;
var string1 = "";

function removeEduPressed() {
    let val = val1 - 1;
    let str = ".remedu" + val;
    let str2 = ".edu-" + val;
    $(str2).remove();
    val1--;
}

function removeExpPressed() {
    let vall = val2 - 1;
    let str3 = ".remexp" + vall;
    let str4 = ".exp-" + vall;
    $(str4).remove();
    console.log(str4);
    val2--;
}

function removeSkillPressed() {
    let valll = val3 - 1;
    let str5 = ".remskill" + valll;
    let str6 = ".skills-" + valll;
    $(str6).remove();
    console.log(str6);
    val3--;
}
$(document).ready(() => {
    $('#addEducation').click(() => {
        $('#education').append("<div class='cvform edu-" + val1 + "'><input type='text' name='course-title-" + val1 + "' placeholder='Your course name'><input type='text' name='course-inst-" + val1 + "' placeholder='Your Institution&apos;s name'><input type='text' name='course-begin-" + val1 + "' placeholder='Course start year'><input type='text' name='course-end-" + val1 + "' placeholder='Course ended. Blank for present'><textarea name='course-detail-" + val1 + "' id='' cols='30' rows='10' placeholder='Add your course Details'></textarea><a href='javascript:;' onclick='removeEduPressed();' class='links remedu" + val1 + "' >Remove</a></div>");
        val1++;
    });
    $('#addExperience').click(() => {
        $('#experience').append("<div class='cvform exp-" + val2 + "'><input type='text' name='emp-title-" + val2 + "' placeholder='Job title | Designation'><input type='text' name='emp-comp-" + val2 + "' placeholder='Add the company&apos;s name.'><input type='text' name='emp-begin-" + val2 + "' placeholder='Start year'><input type='text' name='emp-end-" + val2 + "' placeholder='End Year | Blank for Current'><textarea name='emp-detail-" + val2 + "' id='' cols='30' rows='10' placeholder='Explain your role'></textarea><a href='javascript:;' onclick='removeExpPressed();' class='links remexp" + val2 + "' >Remove</a></div>");
        val2++;
    });
    $('#addSkill').click(() => {
        $('#skill-set').append("<div class='skillinp skills-" + val3 + "'><div class='inpgrp'><input id='skills' name='skill-type-" + val3 + "' class='input1' placeholder='Add skill type. Eg. Language'><input id='skills' name='skill-list-" + val3 + "' class='input1' placeholder='Add skills. Eg. English, French, Spanish'></div><a href='javascript:;' onclick='removeSkillPressed();' class='links remskill" + val3 + "' >Remove</a></div></div>");
        val3++;
    });
});