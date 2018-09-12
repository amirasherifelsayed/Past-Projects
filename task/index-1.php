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
         
             
             //valid First Name
             if(document.getElementById("fname").value.length == 0){
                errormsg += "All fields are manadatory, enter your First Name \n";
                document.getElementById("fname").style.borderColor="red";
             } else if(!document.getElementById("fname").value.match(alphaExpName)){
                 errormsg += "Your first name should only include Letters \n";
                 document.getElementById("fname").style.borderColor="red";
             } else {
               document.getElementById("fname").style.borderColor="";  
             }
             
             //valid Last Name
             if(document.getElementById("lname").value.length == 0){
                errormsg += "All fields are manadatory, enter your Last Name \n";
                document.getElementById("lname").style.borderColor="red";
             } else if(!document.getElementById("fname").value.match(alphaExpName)){
                 errormsg += "Your first name should only include Letters \n";
                 document.getElementById("lname").style.borderColor="red";
             } else {
               document.getElementById("lname").style.borderColor="";  
             }
             
            //valid Username
             if(document.getElementById("uname").value.length == 0){
                errormsg += "All fields are manadatory, enter your Username \n";
                document.getElementById("uname").style.borderColor="red";
             } else {
               document.getElementById("uname").style.borderColor="";  
             }
             
              //valid Email
             if(document.getElementById("email").value.length == 0){
                errormsg += "All fields are manadatory, enter your Email \n";
                document.getElementById("email").style.borderColor="red";
             } else if(!document.getElementById("email").value.match(alphaExpMail)){
                 errormsg += "Please provide a valid email \n";
                 document.getElementById("email").style.borderColor="red";
             } else {
               document.getElementById("email").style.borderColor="";  
             }
             
             //valid Birthdate
             if(document.getElementById("birthdate").value.length == 0){
                errormsg += "All fields are manadatory, enter your Birthdate \n";
                document.getElementById("birthdate").style.borderColor="red";
             } else {
               document.getElementById("birthdate").style.borderColor="";  
             }
             
             //valid password
              if(document.getElementById("password").value.length == 0 || document.getElementById("matchpassword").value.length == 0 ){
                  
                errormsg += "All fields are manadatory, enter and confirm your Password \n";
                document.getElementById("password").style.borderColor="red";
                document.getElementById("matchpassword").style.borderColor="red";
                  
             } else if(document.getElementById('password').value != document.getElementById('matchpassword').value ){
                 errormsg += "Your passwords don't match, please try again \n";
                 document.getElementById("password").style.borderColor="red";
                 document.getElementById("matchpassword").style.borderColor="red";
         
             } else {
               document.getElementById("password").style.borderColor="";  
               document.getElementById("matchpassword").style.borderColor=""; 
             }
              
            
             //valid image
             if(document.getElementById("image").value.length != 0){
                 
             var FileUploadPath = document.getElementById('image').value;
            var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
            if (Extension == "gif" || Extension == "png" || Extension == "jpeg" || Extension == "jpg") {
            var name = document.getElementById('image'); 
            } else {
               errormsg +="Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ";
            }
             if(errormsg.length == 0){
                 return true;
             }else {
                 alert(errormsg);
                 return false;
             }
             }
         
      </script>
   </head>
   <body>
      <h2>Registration Form</h2>
      <form method="post" name="Form" onsubmit="return validateForm()" action="process-1.php" enctype="multipart/form-data">
         First name:<br>
         <input type="text" id="fname" name="firstname">
         <br>
         Last name:<br>
         <input type="text" id="lname" name="lastname">
         <br>
         Username:<br>
         <input type="text" id="uname" name="username">
         <br>
         Email:<br>
         <input type="text" id="email" name="email">
         <br>
         Birthdate:<br>
         <input type="date" id="birthdate" name="dob">
         <br>
         Password:<br>
         <input type="password" id="password" name="password">
         <br>
         Confirm Password:<br>
         <input type="password" id="matchpassword" name="matchpassword">
         <br><br>
         Image:<br>
         <input type="file" id ="image" name="image">
         <br><br><br>
         <input type="submit" value="Submit">
         <input type="reset">
          <br><br>
      </form>
       <a href="login-form.php">Login here.</a>
   </body>
</html>