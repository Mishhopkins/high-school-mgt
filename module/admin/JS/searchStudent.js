function getStudent(str){
    var xhttp;
    if (str == "") {
        document.getElementById("bootstrap-data-table").innerHTML = "";
        return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("bootstrap-data-table").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("GET", "searchStudent.php?key="+str, true);
    xhttp.send();
}
