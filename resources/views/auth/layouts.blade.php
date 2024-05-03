<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Custom User Registration & Login </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        label#username-error, label#email-error, label#password-error, label#conpassword-error {
            color: red;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
          <a class="navbar-brand" href="{{ URL('/') }}">Custom Login Register</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('login')) ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('register')) ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
                    </li>
                @else    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->username }}
                        </a>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            >Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </li>
                        </ul>
                    </li>
                @endguest
            </ul>
          </div>
        </div>
    </nav>    

    <div class="container">
        @yield('content')
    </div>
       
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> 
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> 

    @yield('js')

    <script>
        $(document).ready(function () { 
        
            $("#register-user").validate({ 
                // In 'rules' user have to specify all the  
                // constraints for respective fields 
                rules: { 
                    username: { 
                        required: true, 
                        minlength: 3 ,// For length of username 
                        lettersonly: true
                    }, 
                    password: { 
                        required: true, 
                        minlength: 6,
                        // pattern: "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$"
                    }, 
                    password_confirmation: { 
                        required: true, 
                        minlength: 3, 

                        // For checking both passwords are same or not 
                        equalTo: "#password"
                    }, 
                    email: { 
                        required: true, 
                        email: true
                    },
                }, 
                // In 'messages' user have to specify message as per rules 
                messages: { 
                    
                    username: { 
                        required: " Please enter a username", 
                        minlength: 
                            " Your username must consist of at least 3 characters",
                        lettersonly: "Please enter valid name"

                    }, 
                    password: { 
                        required: " Please enter a password", 
                        minlength: 
                            " Your password must be consist of at least 6 characters",
                        // pattern: "Minimum 6 characters, at least 1 uppercase letter, 1 lowercase letter, one number and 1 special character, at least min length is 6 and max length is 10"
                    }, 
                    confirm_password: { 
                        required: " Please enter a password", 
                        minlength: 
                            " Your password must be consist of at least 6 characters", 
                        equalTo: " Please enter the same password as above"
                    },
                } 
            });

            // Validate Username 
            $("#usercheck").hide(); 
            let usernameError = true; 
            $("#username").keyup(function () { 
                validateUsername(); 
            }); 
        
                function validateUsername() { 
                    let usernameValue = $("#username").val();

                //     usernameValue.addEventListener("blur", () => { 
                //     let regex = '/^([a-zA-Z]){3,20}$/'; 
                //     let s = usernameValue.value; 
                //     if (regex.test(s)) { 
                //         alert('1');
                //         usernameValue.classList.remove("is-invalid"); 
                //         usernameError = true; 
                //     } else { 
                //         usernameValue.classList.add("is-invalid"); 
                //         usernameError = false; 
                //     } 
                // });

                if (usernameValue.length == "") { 
                    $("#usercheck").show(); 
                    usernameError = false; 
                    return false; 
                } else if (usernameValue.length < 3 || usernameValue.length > 20) { 
                    $("#usercheck").show(); 
                    $("#usercheck").html("length of username must be between 3 and 20"); 
                    usernameError = false; 
                    return false; 
                } else { 
                    $("#usercheck").hide(); 
                } 
            } 
        
            // Validate Email 
            const email = document.getElementById("email"); 
            email.addEventListener("blur", () => { 
                let regex =  
                /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/; 
                let s = email.value; 
                if (regex.test(s)) { 
                    email.classList.remove("is-invalid"); 
                    emailError = true; 
                } else { 
                    email.classList.add("is-invalid"); 
                    emailError = false; 
                } 
            }); 

            // $("#email").keyup(function () { 
            //     $("div:nth-child(3)").hide();
            // });
        
            // Validate Password 
            $("#passcheck").hide(); 
            let passwordError = true; 
            $("#password").keyup(function () { 
                validatePassword();
            }); 
            function validatePassword() { 
                let passwordValue = $("#password").val(); 
                if (passwordValue.length == "") { 
                    $("#passcheck").show(); 
                    passwordError = false; 
                    return false; 
                } 
                if (passwordValue.length < 6 || passwordValue.length > 10) { 
                    $("#passcheck").show(); 
                    $("#passcheck").html( 
                        "length of your password must be between 6 and 10"
                    ); 
                    $("#passcheck").css("color", "red"); 
                    passwordError = false; 
                    return false; 
                } else { 
                    $("#passcheck").hide(); 
                } 
            } 
        
            // Validate Confirm Password 
            $("#conpasscheck").hide(); 
            let confirmPasswordError = true; 
            $("#conpassword").keyup(function () { 
                validateConfirmPassword(); 
            }); 
            function validateConfirmPassword() { 
                let confirmPasswordValue = $("#conpassword").val(); 
                let passwordValue = $("#password").val(); 
                if (passwordValue != confirmPasswordValue) { 
                    $("#conpasscheck").show(); 
                    $("#conpasscheck").html("Password didn't Match"); 
                    $("#conpasscheck").css("color", "red"); 
                    confirmPasswordError = false; 
                    return false; 
                } else { 
                    $("#conpasscheck").hide(); 
                } 
            } 
        
            // Submit button 
            $("#submitbtn").click(function () { 
                validateUsername(); 
                validatePassword(); 
                validateConfirmPassword(); 
                validateEmail(); 
                if ( 
                    usernameError == true && 
                    passwordError == true && 
                    confirmPasswordError == true && 
                    emailError == true
                ) { 
                    console.log('12');
                    return true; 
                } else { 
                    return false; 
                } 
            });

        });
    </script>
</body>
</html>