
function removeUser(index) {

    window.location.href = "index.php?delete=" + index;
}


function addUser(event) {
    event.preventDefault();


    var name = document.getElementById("name").value;
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var address = document.getElementById("address").value;
    var phone = document.getElementById("phone").value;
    var company = document.getElementById("company").value;


    var xhr = new XMLHttpRequest();
    xhr.open("POST", "index.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {

            window.location.reload();
        }
    };
    xhr.send(
        "name=" + encodeURIComponent(name) +
        "&username=" + encodeURIComponent(username) +
        "&email=" + encodeURIComponent(email) +
        "&address=" + encodeURIComponent(address) +
        "&phone=" + encodeURIComponent(phone) +
        "&company=" + encodeURIComponent(company)
    );
}


document.getElementById("submit-button").addEventListener("click", addUser);
var removeButtons = document.getElementsByClassName("remove-button");
for (var i = 0; i < removeButtons.length; i++) {
    removeButtons[i].addEventListener("click", function () {
        var index = this.getAttribute("data-index");
        removeUser(index);
    });
}
``
