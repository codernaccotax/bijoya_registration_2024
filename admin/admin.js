var doc = document;
var allStudentsButton = doc.getElementById('all-students');
allStudentsButton.addEventListener('click', function () {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        document.getElementById("result").innerHTML = this.responseText;
    }
    xhttp.open("GET", "students.php", true);
    xhttp.send();
});

//for veg students
var avegStudentsButton = doc.getElementById('veg-students');
avegStudentsButton.addEventListener('click', function () {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        document.getElementById("result").innerHTML = this.responseText;
    }
    xhttp.open("GET", "veg_students.php", true);
    xhttp.send();
});

//for non veg students
var avegStudentsButton = doc.getElementById('nonveg-students');
avegStudentsButton.addEventListener('click', function () {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        document.getElementById("result").innerHTML = this.responseText;
    }
    xhttp.open("GET", "nonveg_students.php", true);
    xhttp.send();
});

