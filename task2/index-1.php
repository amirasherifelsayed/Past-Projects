<!DOCTYPE html>
<html>
   <head>
      <script>
         function validateForm()
         {
             
            var errormsg="";
            var alphaExpName = /^[a-zA-Z]/;
            var alphaExpMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})/;
            var alphaExpDate = /^([0-9]{2})-([0-9]{2})-([0-9]{4})$/;
	// valid Username

	if (document . getElementById("uname") . value . length == 0)
		{
		errormsg+= "All fields are manadatory, enter your Username \n";
		document . getElementById("uname") . style . borderColor = "red";
		}
	  else
		{
		document . getElementById("uname") . style . borderColor = "";
		}

	// valid Email

	if (document . getElementById("email") . value . length == 0)
		{
		errormsg+= "All fields are manadatory, enter your Email \n";
		document . getElementById("email") . style . borderColor = "red";
		}
	  else
	if (!document . getElementById("email") . value . match(alphaExpMail))
		{
		errormsg+= "Please provide a valid email \n";
		document . getElementById("email") . style . borderColor = "red";
		}
	  else
		{
		document . getElementById("email") . style . borderColor = "";
		}

	// valid password

	if (document . getElementById("password") . value . length == 0 || document . getElementById("matchpassword") . value . length == 0)
		{
		errormsg+= "All fields are manadatory, enter and confirm your Password \n";
		document . getElementById("password") . style . borderColor = "red";
		document . getElementById("matchpassword") . style . borderColor = "red";
		}
	  else
	if (document . getElementById('password') . value != document . getElementById('matchpassword') . value)
		{
		errormsg+= "Your passwords don't match, please try again \n";
		document . getElementById("password") . style . borderColor = "red";
		document . getElementById("matchpassword") . style . borderColor = "red";
		}
	  else
		{
		document . getElementById("password") . style . borderColor = "";
		document . getElementById("matchpassword") . style . borderColor = "";
		}

	if (errormsg . length == 0)
		{
		return true;
		}
	  else
		{
		alert(errormsg);
		return false;
		}
	}

</script>
   </head>
   <body>
      <h2>Registration Form</h2>
      <form method="post" name="Form" onsubmit="return validateForm()" action="process-1.php" >
         Username:<br />
         <input type="text" id="uname" name="username">
         <br />
         Email:<br />
         <input type="text" id="email" name="email">
         <br />
         Password:<br />
         <input type="password" id="password" name="password">
         <br />
         Confirm Password:<br />
         <input type="password" id="matchpassword" name="matchpassword">
         <br /><br />
         <input type="submit" value="Submit">
         <input type="reset">
          <br /><br />
      </form>
       <a href="login-form.php">Login here.</a>
   </body>
</html>