<?php
    session_start();
    include("Connect.php");
    include("SQL.php");
    include('config.php');

    $login_button = '';


    if(isset($_GET["code"]))
    {
        $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

        if(!isset($token['error']))
        {
        
            $google_client->setAccessToken($token['access_token']);

            $_SESSION['access_token'] = $token['access_token'];

            $google_service = new Google_Service_Oauth2($google_client);
            
            $data = $google_service->userinfo->get();
            
            if(!empty($data['given_name']))
            {
                if(!empty($data['family_name']))
                {
                    $_SESSION['User_Name'] = $data['given_name'] . " " .  $data['family_name'];

                    if(!empty($data['email']))
                    {
                        $_SESSION['User_Email'] = $data['email'];

                        $Check  = Multi_Select("*", "Customer", "Email", $_SESSION['User_Email']);

                        if(mysqli_num_rows($Check) > 0)
                        {
                            $Rows                   = mysqli_fetch_array($Check);
                            $_SESSION['User_ID']    = $Rows['ID'];

                            if(isset($_SESSION['Location']))
                            {
                                echo("<script>window.alert('Login Successfull.')</script>");
                                echo("<script>window.location='" . $_SESSION['Location']  . "' </script>");
                            }
                            else
                            {
                                echo("<script>window.alert('Login Successfull.')</script>");   
                                echo("<script>window.location='Home.php' </script>");
                            }
                        }
                        else 
                        {
                            $ID     = Max_ID("ID", "Customer");

                            if(Insert_Data("Customer", "(ID, Name, Email)", "('" . $ID . "', '" . $_SESSION['User_Name'] . "', '" . $_SESSION['User_Email'] . "')"))
                            {
                                $_SESSION['User_ID'] = $ID;
                                if(isset($_SESSION['Location']))
                                {
                                    echo("<script>window.alert('Sing up Successfull.')</script>");
                                    echo("<script>window.location='" . $_SESSION['Location']  . "' </script>");
                                }
                                else
                                {
                                    echo("<script>window.alert('Sing up Successfull.')</script>");   
                                    echo("<script>window.location='Home.php' </script>");
                                }
                            }
                            else
                            {
                                echo("<script>window.alert('Error. Please try againg later.')</script>");   
                                echo("<script>window.location='User_Login.php' </script>");
                            }
                        }
                    }
                }
            }
        }
    }


    if(!isset($_SESSION['access_token']))
    {
        $login_button = $google_client->createAuthUrl();
    }
    else
    {
        echo("<script>window.location='Home.php' </script>");
    }


    if(isset($_POST['btnLogin']))
    {
        $Email      = $_POST['txtEmail'];
        $Password   = $_POST['txtPassword'];
        $Check      = Match_Data("*", "Customer", "Email", $Email, "AND",  "Password", $Password);

        if(mysqli_num_rows($Check) > 0)
        {
            $CRows                  = mysqli_fetch_array($Check);
            $_SESSION['User_ID']    = $CRows['ID'];
            $_SESSION['User_Name']  = $CRows['Name'];
            $_SESSION['User_Email'] = $CRows['Email'];

            if(isset($_SESSION['Location']))
            {
                echo("<script>window.alert('Login Successfull.')</script>");
                echo("<script>window.location='" . $_SESSION['Location']  . "' </script>");
            }
            else
            {
                echo("<script>window.alert('Login Successfull.')</script>");   
                echo("<script>window.location='Home.php'</script>");
            }
        }
        else
        {
            echo("<script>window.alert('Error!')</script>");   
            echo("<script>window.location='User_Login.php'</script>");
        }
    }

    if(isset($_POST['btnSingup']))
    {
        $ID         = Max_ID("ID", "Customer");
        $Name       = $_POST['txtName'];
        $Phone      = $_POST['txtPhone'];
        $Email      = $_POST['txtEmail'];
        $Password   = $_POST['txtPassword'];
        $CPassword  = $_POST['txtCPassword'];

        if($Password == $CPassword)
        {
            if(mysqli_num_rows(Multi_Select("*", "Customer", "Email", $Email)) > 0)
            {
                echo("<script>window.alert('User with the same email already exists!')</script>");   
                echo("<script>window.location='User_Login.php'</script>");
            }
            else 
            {
                if(Insert_Data("Customer", "(ID, Name, Ph_No, Email, Password)", "('" . $ID . "', '" . $Name . "', '" . $Phone . "', '" . $Email . "', '" . $Password . "')"))
                {
                    $_SESSION['User_ID']    = $CRows['ID'];
                    $_SESSION['User_Name']  = $CRows['Name'];
                    $_SESSION['User_Email'] = $CRows['Email'];

                    if(isset($_SESSION['Location']))
                    {
                        echo("<script>window.alert('Sing up Successfull.')</script>");
                        echo("<script>window.location='" . $_SESSION['Location']  . "' </script>");
                    }
                    else
                    {
                        echo("<script>window.alert('Sing up Successfull.')</script>");   
                        echo("<script>window.location='Home.php'</script>");
                    }
                }
                else 
                {
                    echo("<script>window.alert('Error!')</script>");   
                    echo("<script>window.location='User_Login.php'</script>");
                }
            }
        }
        else 
        {
            echo("<script>window.alert('Passwords didn't match!')</script>");   
            echo("<script>window.location='User_Login.php'</script>");   
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="Login.css">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/thinline.css">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.5/css/unicons.css">


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


        <title>Login</title>
    </head>
    <body>
        <div class="Form_Container Sing-in-Form">
            <div class="Form_Box Sing-in-Box">
                <h2>Login</h2>

                <form action="User_Login.php" method="post">
                    <div class="Field">
                        <i class="uil uil-at"></i>
                        <input type="email" placeholder="Email" name="txtEmail" required>
                    </div>

                    <div class="Field">
                        <i class="uil uil-lock-alt"></i>
                        <input class="Password-input" type="password" placeholder="Password" name="txtPassword" required>
                        <div class="Eye-Btn">
                            <i class="uil uil-eye-slash"></i>
                        </div>
                    </div>

                    <div class="Forget-Link">
                        <a href="#">Forget password?</a>
                    </div>

                    <input class="Submit-Btn" type="submit" name="btnLogin" value="Login" >
                </form>

                <div class="Login-Options">
                    <p class="Text">Or, Login with.....</p>

                    <div class="Other-Logins">
                        <a href="<?php echo $login_button; ?>"><img src="LoginPhoto/google.png">  Log in with Google</a>
                    </div>
                </div>
            </div>

            <div class="Image-Box Sing-in-img-Box">
                <div class="Sliding-Link">
                    <p>Don't have an accont?</p>
                    <span class="Sing-up-Btn">Sing up</span>
                </div>

                <img src="LoginPhoto/signin-img.png" alt="">
            </div>
        </div>


        <div class="Form_Container Sing-up-Form">
            <div class="Image-Box Sing-up-img-Box">
                <div class="Sliding-Link">
                    <p>ALready a user?</p>
                    <span class="Sing-in-Btn">Sing in</span>
                </div>

                <img src="LoginPhoto/signup-img.png" alt="">
            </div>

            <div class="Form_Box Sing-up-Box">
                <h2>Sing up</h2>

                <div class="Login-Options">
                    <div class="Other-Logins">
                        <a href="<?php echo $login_button; ?>"><img src="LoginPhoto/google.png">  Sing up with Google</a>
                    </div>

                    <p class="Text">Or, Sing up with Email .....</p>
                </div>

                <form action="User_Login.php" method="post">
                    <div class="Field">
                        <i class="uil uil-user"></i>
                        <input type="Text" placeholder="Name" name="txtName" required>
                    </div>

                    <div class="Field">
                        <i class="uil uil-mobile-android"></i>
                        <input type="text" placeholder="Phone" name="txtPhone" required>
                    </div>

                    <div class="Field">
                        <i class="uil uil-at"></i>
                        <input type="email" placeholder="Email" name="txtEmail" required>
                    </div>

                    <div class="Field">
                        <i class="uil uil-lock-alt"></i>
                        <input  type="password" placeholder="Password" name="txtPassword" required>
                    </div>

                    <div class="Field">
                        <i class="uil uil-lock-access"></i>
                        <input  type="password" placeholder="Confirm Password" name="txtCPassword" required>
                    </div>

                    <input class="Submit-Btn" type="submit" name="btnSingup" value="Sing up" >
                </form>
            </div>
        </div>
        
        
        <script>
            const Text_Input = document.querySelectorAll("input");
            Text_Input.forEach(Text_Input => {
                Text_Input.addEventListener("focus", () => {
                    let Parent = Text_Input.parentNode;
                    Parent.classList.add("Active");
                });

                Text_Input.addEventListener("blur", () => {
                    let Parent = Text_Input.parentNode;
                    Parent.classList.remove("Active");
                });
            });

            const Password_Input = document.querySelector(".Password-input");
            const Eye_Btn = document.querySelector(".Eye-Btn");

            Eye_Btn.addEventListener("click", () => {
                if(Password_Input.type ==  "password")
                {
                    Password_Input.type = "text";
                    Eye_Btn.innerHTML = "<i class='uil uil-eye'></i>"
                }
                else
                {
                    Password_Input.type = "password";
                    Eye_Btn.innerHTML = "<i class='uil uil-eye-slash'></i>"
                }
            });

            const Sing_up_Btn = document.querySelector(".Sing-up-Btn");
            const Sing_in_Btn = document.querySelector(".Sing-in-Btn");
            const Sing_up_From = document.querySelector(".Sing-up-Form");
            const Sing_in_From = document.querySelector(".Sing-in-Form");

            Sing_up_Btn.addEventListener("click", () => {
                Sing_in_From.classList.add("Hide");
                Sing_up_From.classList.add("Show");
                Sing_in_From.classList.remove("Show");
            });

            Sing_in_Btn.addEventListener("click", () => {
                Sing_in_From.classList.remove("Hide");
                Sing_up_From.classList.remove("Show");
                Sing_in_From.classList.add("Show");
            });
        </script>
    </body>
</html>