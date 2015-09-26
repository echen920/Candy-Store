<!html>

<html>
  <head>
    <title>Candy Store</title>
    <link rel="stylesheet" type="text/css" href="/candystore/css/style.css" media="all"/>
  </head>
  
  <body>
    <h2>Candy Store</h2>
    <?php echo validation_errors(); ?>
    
    <?php echo "<p>" . anchor('candystore/newAccount','Create New Account') . "</p>"; 
    echo form_open_multipart('candystore/viewList');?>
    <label for="username">Username:</label>
    <input type="text" size ="20" id="username" name="username"/><br/>
    
    <label for="password">Password:</label>
    <input type="password" size ="20" id="password" name="password"/><br/>

    <input type="submit" value="Login"/>
  </body>

</html>
