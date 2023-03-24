document.querySelector(".gotologin").onclick = function(){
    document.querySelector(".signup-block").style.display="none"
    document.querySelector(".login-block").style.display="block"
}
document.querySelector(".gotosignup").onclick = function(){
    document.querySelector(".signup-block").style.display="block"
    document.querySelector(".login-block").style.display="none"
}

function validateLogin() {
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    if (username === "" || password === "") {
      if (username === "") {
        document.getElementById("usernameError").innerHTML = "Please enter your username";
      }
      if (password === "") {
        document.getElementById("passwordError").innerHTML = "Please enter your password";
      }
      return false;
    }
    return true;
  }

  function validateSignup() {
    const name = document.getElementById("Name").value;
    const address = document.getElementById("Address").value;
    const email = document.getElementById("Email").value;
    const phone = document.getElementById("Phone").value;
    const cin = document.getElementById("CIN").value;
    const birthDate = document.getElementById("BirthDate").value;
    const retryPassword = document.getElementById("retryPassword").value;
    let isValid = true;
  
    // Validate name
    if (name === "") {
      document.getElementById("nameError").innerHTML = "Please enter your full name";
      isValid = false;
    } else {
      document.getElementById("nameError").innerHTML = "";
    }
  
    // Validate address
    if (address === "") {
      document.getElementById("addressError").innerHTML = "Please enter your address";
      isValid = false;
    } else {
      document.getElementById("addressError").innerHTML = "";
    }
  
    // Validate email
    if (email === "") {
      document.getElementById("emailError").innerHTML = "Please enter your email";
      isValid = false;
    } else {
      document.getElementById("emailError").innerHTML = "";
    }
  
    // Validate phone
    if (phone === "") {
      document.getElementById("phoneError").innerHTML = "Please enter your phone number";
      isValid = false;
    } else {
      document.getElementById("phoneError").innerHTML = "";
    }
  
    // Validate CIN
    if (cin === "") {
      document.getElementById("cinError").innerHTML = "Please enter your CIN";
      isValid = false;
    } else {
      document.getElementById("cinError").innerHTML = "";
    }
  
    // Validate birth date
    if (birthDate === "") {
      document.getElementById("birthDateError").innerHTML = "Please enter your birth date";
      isValid = false;
    } else {
      document.getElementById("birthDateError").innerHTML = "";
    }
  
    // Validate username
    const Username = document.getElementById("username2").value;
    if (Username === "") {
      document.getElementById("usernameError2").innerHTML = "Please enter a username";
      isValid = false;
    }else if (Username.length < 6) {
        document.getElementById("usernameError2").innerHTML = "Username should be at least 6 characters long";
        isValid = false;
      }
     else {
      document.getElementById("usernameError2").innerHTML = "";
    }
   // Validate password
   const Password = document.getElementById("password2").value;
   if (Password === "") {
     document.getElementById("passwordError2").innerHTML = "Please enter a password";
     isValid = false;
   } else if (Password.length < 8) {
     document.getElementById("passwordError2").innerHTML = "Password should be at least 8 characters long";
     isValid = false;
   } else if (!/\d/.test(Password)) {
     document.getElementById("passwordError2").innerHTML = "Password should contain at least one number";
     isValid = false;
   } else {
     document.getElementById("passwordError2").innerHTML = "";
   }
  
    // Validate retry password
    if (retryPassword === "") {
      document.getElementById("retryPasswordError").innerHTML = "Please retry your password";
      isValid = false;
    } else if (Password !== retryPassword) {
      document.getElementById("retryPasswordError").innerHTML = "Passwords do not match";
      isValid = false;
    } else {
      document.getElementById("retryPasswordError").innerHTML = "";
    }
  
    return isValid;
  }
  


/*/////////////// for signup */
  function togglePasswordVisibility() {
    const passwordInput = document.getElementById("password2");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
    } else {
      passwordInput.type = "password";
    }
  }
/*/////////////// for loging */
function togglePasswordVisibility2() {
    const passwordInput = document.getElementById("password");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
    } else {
      passwordInput.type = "password";
    }
  }


