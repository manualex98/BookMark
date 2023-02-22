function show1() { 
    var password1 = document.getElementById("password1"); 
    if (password1.type === "password") { 
        password1.type = "text";
        $("i").removeClass('fa-eye-slash');
        $("i").addClass('fa-eye');
    } 
    else { 
        password1.type = "password";
        $("i").removeClass('fa-eye');
        $("i").addClass('fa-eye-slash');
    } 
}

function clean(){
    var password = document.getElementById("password1");
    password.value="";
    var checkbox = document.getElementById("ckbox");
    checkbox.disabled=false;
    
}
function checkEmail() {
    let input = document.accountForm.email;
    let email = input.value.toLowerCase().trim();
    let regex = new RegExp(/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/, 'i');
    if (email.match(regex)) {
        input.setCustomValidity('');
        input.style.borderColor = "rgb(167, 250, 167)";
        document.getElementById("button1").disabled=false;
        return true;
    }
    else {
        input.setCustomValidity('Inserisci un email valida');
        input.style.borderColor = "rgb(255, 102, 102)";
        document.getElementById("button1").disabled=true;
        return false;
    }
}

function checkPassword() {
    let input = document.accountForm.password;
    let password = input.value;
    let spazio = password.indexOf(" ");
    if (spazio!=-1) {																				
        input.setCustomValidity('La password non può contenere spazi');
        input.style.borderColor = "rgb(255, 102, 102)";
        document.getElementById("button3").disabled=true;
        return false;
    }
    else if (password.length < 8) {
        input.setCustomValidity('La password deve avere almeno 8 caratteri.');
        input.style.borderColor = "rgb(255, 102, 102)";
        document.getElementById("button3").disabled=true;
        return false;
    }
    else{
        input.setCustomValidity("");
        input.style.borderColor = "rgb(167, 250, 167)";
        document.getElementById("button3").disabled=false;
        return true;
    }
}