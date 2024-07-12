function func(){
    var username = document.getElementById(username);
    var password = document.getElementById(password);
    if(username =="Myuser" && password =="SA1@123"){
    alert("Welcome Admin ");
    window.location.href("dashboard.html");
    }else{
    alert("unsuccessful login credentials ");
    }
    function validate(field){
        fail = validateusername(form.validateusername.value);
        fail = validatepassword(form.validatepassword.value);
        if (fail == " "){
            return true
            } else {    
            alert(fail); return false
            }
        }
        function validateusername(field){
            return(field == " ")? " No name was entered.\n":" ";
            }
            function validatepassword(field){
            return(field == " ")? " No password was entered.\n":" ";
            }
}
function validateForm() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // Check if username is empty
    if (username == "") {
        alert("Username must be filled out");
        return false;
    }

    // Check if password is empty
    if (password == "") {
        alert("Password must be filled out");
        return false;
    }

    // If both fields are filled out, return true to allow form submission
    return true;
}
