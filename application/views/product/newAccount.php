<!html>

<html>
  <head>
    <title>Create New Account</title>
  </head>
  
  <body>
    <h2>Create New Account</h2>
    <?php echo validation_errors(); ?>
    
    <?php echo "<p>" . anchor('candystore/index','Back') . "</p>"; 
    echo form_open_multipart('candystore/createAccount');?>
    
    <label for="first">First Name:</label>
    <input type="text" size ="20" id="first" name="first"/><br/>
    
    <label for="last">Last Name:</label>
    <input type="text" size ="20" id="last" name="last"/><br/>
    
    <label for="username">Username:</label>
    <input type="text" size ="20" id="username" name="username"/><br/>
    
    <label for="passwd">Password:</label>
    <input type="password" size ="20" id="passwd" name="passwd"/><br/>
    
    <label for="email">Email:</label>
    <input type="email" size ="20" id="email" name="email"/><br/>
    
    <input type="submit" value="Create"/>
  </body>

</html>
