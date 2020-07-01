<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <p id="msg"></p>
    <form name="registration" method="post">
        <table>
            <tr>
                <td>First name: </td>
                <td><input type="text" name="fname" id="fname"></td>
            </tr>
            <tr>
                <td>Last name: </td>
                <td><input type="text" name="lname" id="lname"></td>
            </tr>
            <tr>
                <td>Email id: </td>
                <td><input type="email" name="email" id="email"></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td><input type="password" name="password" id="password"></td>
            </tr>

            <tr>
                <td><input type="button" name="submit" id="register" value="Register"></td>
            </tr>
        </table>
    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#register').on('click',function(){

                var fname=$('#fname').val();
                var lname=$('#lname').val();
                var email=$('#email').val();
                var password=$('#password').val();
                if (fname==""||lname==""||email==""||password=="")
                {
                    alert("Please fill all entries!!");
                }

                $.ajax({
                    type:"post",
                    url:"adduser.php",
                    data:{
                        fname: fname,
                        lname: lname,
                        email: email,
                        password: password,
                        },
                    success:function(html){
                        if(html=='true'){
                            $('#msg').html('<div class="alert alert-success">You have registered successfully!</div>');
                        }
                        else if(html=='fname'){
                            $('#msg').html('<div class="alert alert-danger">Error: First name is too short!</div>');
                        }
                        else if(html=='lname'){
                            $('#msg').html('<div class="alert alert-danger">Error: Last name is too short!</div>');
                        }
                        else if(html=='false'){
                            $('#msg').html('<div class="alert alert-danger">Error: This email id is already registered!</div>');
                        }
                        else if (html=='eformat'){
                            $('#msg').html('<div class="alert alert-danger">Error: Wrong email id format!</div>');
                        }
                        else if(html=='pshort'){
                            $('#msg').html('<div class="alert alert-danger">Error: Password is too short</div>');
                        }
                    }
                });
                return false;
            });
        });
    </script>

</body>
</html>