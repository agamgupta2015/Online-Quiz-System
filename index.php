
<?php
	# This is the PHP function Login button
	require('database.php');
	session_start();
	if(isset($_SESSION["email"]))
	{
		session_destroy();
	}
	
	$ref=@$_GET['q'];		
	if(isset($_POST['submit']))
	{	
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$email = stripslashes($email);
		$email = addslashes($email);
		
		$password = stripslashes($password); 
		$password = addslashes($password);
		
		$email = mysqli_real_escape_string($con,$email);
		$password = mysqli_real_escape_string($con,$password);	
		
		$str = "select * from user where email='$email' and password='$password' ";
		$result = mysqli_query($con,$str);
		if((mysqli_num_rows($result))!=1) 
		{
			echo "<center><h3><script>alert('Sorry.. Wrong Username (or) Password');</script></h3></center>";
			header("refresh:0;url=index.php");
		}
		else
		{
			$_SESSION['logged']=$email;
			$row = mysqli_fetch_array($result);
			$_SESSION['name']=$row[1];
			$_SESSION['id']=$row[0];
			$_SESSION['email']=$row[2];
			$_SESSION['password']=$row[3];
			header('location:welcome.php?=0'); 					
		}
	}
?>
 
<?php
	# This is the PHP function for registering when login id not present
	include_once 'database.php';
	if(isset($_POST['submit1']))
	{	
		$name = $_POST['name'];
		$name = stripslashes($name);
		$name = addslashes($name);

		$email = $_POST['email'];
		$email = stripslashes($email);
		$email = addslashes($email);

		$password = $_POST['password'];
		$password = stripslashes($password);
		$password = addslashes($password);

		$college = $_POST['college'];
		$college = stripslashes($college);
		$college = addslashes($college);
		
		$str="SELECT email from user WHERE email='$email'";
		$result=mysqli_query($con,$str);
		
		if((mysqli_num_rows($result))>0)	
		{
            echo "<center><h3><script>alert('Sorry.. This email is already registered !!');</script></h3></center>";
        }
		else
		{
            $str="insert into user set name='$name',email='$email',password='$password',college='$college'";
			if((mysqli_query($con,$str)))	
			echo "<center><h3><script>alert('Congrats.. You have successfully registered !!');</script></h3></center>";
		}
    }
?>


<?php
	# PHP function for Admin login
    include_once 'database.php';
    if(isset($_SESSION["email1"]))
	{
		session_destroy();
    }
    
    $ref=@$_GET['q'];
    if(isset($_POST['submit3']))
	{	
        $email = $_POST['email1'];
        $password = $_POST['password1'];

        $email = stripslashes($email);
        $email = addslashes($email);
        $password = stripslashes($password); 
        $password = addslashes($password);

        $email = mysqli_real_escape_string($con,$email);
        $password = mysqli_real_escape_string($con,$password);
        
        $result = mysqli_query($con,"SELECT email FROM admin WHERE email = '$email' and password = '$password'") or die('Error');
        $count=mysqli_num_rows($result);
        if($count==1)
        {
            session_start();
            if(isset($_SESSION['email']))
            {
                session_unset();
            }
            $_SESSION["name"] = 'Admin';
            $_SESSION["key"] ='admin';
            $_SESSION["email"] = $email;
            header("location:dashboard.php?q=0");
        }
        else
        {
            echo "<center><h3><script>alert('Sorry.. Wrong Username (or) Password');</script></h3></center>";
            header("refresh:0;url=index.php");
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
<style>
	html{
	  scroll-behavior: smooth; <!-- for smooth scrolling -->
	}
</style>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Web Site</title>

    <!--Scripts-->
    <script src="https://kit.fontawesome.com/dad2b35d63.js" crossorigin="anonymous"></script>

    <!--javacript Script-->
    <script src="./Script/JS/index.js"></script>
    <script src="./Script/JS/nav_bar.js"></script>
	
    <!--StyleSheet-->
    <link rel="stylesheet" href="./Script/CSS/index.css">
	<link rel="stylesheet" href="./Script/CSS/style1.css">
    <link rel="stylesheet" href="./Script/CSS/navbar_style.css">
    <link rel="stylesheet" href="./Script/CSS/login_button.css">
	<link rel="stylesheet" href="css/f_style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</head>

<body style="background-color:bisque";>
    <nav class="navbar" style="  position: fixed;width: -webkit-fill-available;z-index: 3;">
        <div class="navbar_logo">
            <img src="img/logo.jpg" 
			 width="50px" border-radius:"50px" height="50px" alt=" Online Quiz Logo" style="border-radius:50px">
			 <a href="#" style="position: relative; top: -16px;" >ONLINE QUIZ WEB</a>
        </div>
        <ul class="navbar_menu">
            <li><a href="#top" class="nav_btn">Home</a></li>
            <li><a href="#fea" class="nav_btn">Features</a></li>
            <li><a href="#core" class="nav_btn">Team</a></li>
            <li><a href="#faq" class="nav_btn">Contact</a></li>
			<button onclick="document.getElementById('id01').style.display='block'" style="width:70px; height:35px;border-radius:10px;
		   background-color:#f9601e; border:none; cursor:pointer; -webkit-animation: animatezoom 0.6s; animation: animatezoom 0.6s"> <a href="#top">Login</button></a>
		   
		    <button id="01" onclick="document.getElementById('id02').style.display='block' " style="width:70px; height:35px;border-radius:10px;
		   background-color:#f9601e; border:none; cursor:pointer; -webkit-animation: animatezoom 0.6s; animation: animatezoom 0.6s"><a href="#top"> Admin</button> </a>
        </ul>
		
        <ul class="navbar_icons">
            <li>
                <a href="https://twitter.com/i/flow/login"> <i class="fa-brands fa-twitter"></i> <a/>
            </li>
            <li>
                <a href="https://www.facebook.com/"> <i class="fa-brands fa-facebook"></i> <a/>
            </li>
        </ul>
		
    </nav>

	
    <div id="fea" class="Welcome" style="height: 55px; z-index:2">
        <br>
        <marquee behavior="scroll"; direction="left"; scrollamount="12"> <h1 style="font-size: 20px; margin: -3px;" >This is Online QUIZ Site TU AND DU</h1> </marquee>
        <br>
    </div>
    
	<div id="id01" style = "background-color:bisque; display:none; -webkit-animation: animatezoom 0.9s; animation: animatezoom 0.9s;
	transition: opacity .15s linear;">
	 <div class="login-page" >
        <div class="form" style="border-radius:10px">
            <form class="register-form" form method="post" action="index.php" target="_blank">
                <input type="name" name="name" placeholder="username"/>
                <input type="email" name="email" placeholder="email"/>
                <input type="password" name="password" placeholder="password"/>
                <input type="college" name="college" placeholder="college"/>
                <button type="submit1" name="submit1">Sign Up</button>
                <p class="message">Already Registered?<a href="#">Login</a></p>
            </form>
			
            <form class="login-form" form method="post" action="index.php" target="_blank">
                <input type="email" name="email" placeholder="email"/>
                <input type="password" name="password" placeholder="password"/>
                <button type="submit" name="submit">Login</button>
                <p class="message">Not Registered?<a href="#">Sign Up</a></p>
                <p class="message"><a href="#">Forgot Password</a></p></p>
            </form>
        </div>
      </div>
	</div>
	
	<div id="id02" style = "background-color:bisque; display:none; -webkit-animation: animatezoom 0.9s; animation: animatezoom 0.9s;
	transition: opacity .15s linear;">
	 <div class="login-page"  >
        <div class="form" style="border-radius:10px">
            <form class="login-form" form method="post" action="index.php" target="_blank">
                <input type="email1" name="email1" placeholder="email"/>
                <input type="password1" name="password1" placeholder="password"/>
                <button type="submit3" name="submit3">Login</button>
                <p class="message"><a href="#">Forgot Password</a></p></p>
            </form>
        </div>
      </div>
	</div>

	<script>
		var modal = document.getElementById('id01');
		var mod = document.getElementById('id02');
			window.onclick = function(event) {
			  if (event.target == modal|| event.target == mod) {
				modal.style.display = "none";
				mod.style.display = "none";
			  }
			}
	</script>
	
    <script src = "https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.message a').click(function(){
        $('form').animate({height: "toggle", opacity:"toggle"},"slow");
        });
   </script>	

	<div class="container" style="top:16%" >
      <p text-algin="left" class="name">About Quiz / General Instruction </p>
	   <img class="profile-img1" src="img/quiz.jpg" 
	    style="margin: -20px 30px 30px; height:13rem;border-radius:20px;width:25rem;clip-path:circle" align="right" alt="Quiz_image">
      <p class="description" style="padding: 0px 45% 0px 0px;">
	    We have designed this website with the purpose of allowing the students to give exams and view their results.
        This website is an attempt to remove the existing flaws in the manual system of conducting exams. <br>
		Students are provided the flexibility to choose among different tyoes of programming and technical tests.
        Teachers can add and delete quiz and questions and can handle the student details. </p>
    </div>
	
   <div class="wrapper-grid"  style="background-color:bisque;background-color:bisque;position: relative;top: 12%;">
     <div class="container1" style="width:autopx;top:40px";>
      <h1 class="name"></h1>
      <p class="description1" style = "width:auto;text-align:center;"> Types of Quiz offered on our Platform </p>
     </div>
    <br>
	
    <br>
    <div class="container">
      <h1 algin="left" class="name">CSS </h1>
	   <img class="profile-img" src="img/css.jpg" align="right" alt="image">
      <p class="description" style="color: black">CSS is the language we use to style an HTML document.
		CSS describes how HTML elements should be displayed.</p>
	  <p> <button class="button" onclick="document.getElementById('id01').style.display='block'" style= "cursor:pointer; 
	  -webkit-animation: animatezoom 0.6s; animation: animatezoom 0.6s"><a href="#top"> Get Started </button></a></p>
    </div>

    <div class="container">
      <h1 algin="left" class="name"> JavaScrpit</h1>
	   <img class="profile-img" src="img/java.jpg" align="right" alt="image">
      <p class="description">JavaScript is the world's most popular programming language.
	  It is the programming language of the Web.</p>
	  <p> <button class="button" onclick="document.getElementById('id01').style.display='block'" style= "cursor:pointer; 
	  -webkit-animation: animatezoom 0.6s; animation: animatezoom 0.6s"><a href="#top"> Get Started </button></a></p>
    </div>

    <div class="container">
      <p algin="left" class="name">ReactJs</p>
	   <img class="profile-img" src="img/react.jpg" align="right" alt="image">
      <p class="description">React is a JavaScript library for building user interfaces.
		React is used to build single-page applications.</p>
	  <p> <button class="button" onclick="document.getElementById('id01').style.display='block'" style= "cursor:pointer; 
	  -webkit-animation: animatezoom 0.6s; animation: animatezoom 0.6s"><a href="#top"> Get Started </button></a></p>
    </div>

    <div class="container">
      <p text-algin="left" class="name">AngularJs</p>
	   <img class="profile-img" src="img/angular.jpg" align="right" alt="image">
      <p class="description">AngularJS is a very powerful JavaScript Framework. It is used in Single Page Application (SPA) projects.</p>
	  <p> <button class="button" onclick="document.getElementById('id01').style.display='block'" style= "cursor:pointer; 
	  -webkit-animation: animatezoom 0.6s; animation: animatezoom 0.6s"><a href="#top"> Get Started </button></a></p>
    </div>

	<div>
		<h1 id="core" align="center"> CORE - TEAM </h1>
	</div>
	<br><br>
	
	<!-- Core-Team Images -->
	<div style="position: relative;left: 10%;">
	
	<img class="profile-img2" src="img/lee.jpg" align="left" alt="image" style="
		height: 300px;
		margin: 0px 30px 20px;
		width: 18rem;
		padding: 2px; border-radius:500px;">
	
	<img class="profile-img2" src="img/jang.jpg" align="left" alt="image" style="
		height: 300px;
		margin: 0px 30px 20px;
		width: 18rem;
		padding: 2px; border-radius:500px;">
		
	<img class="profile-img2" src="img/kim.jpg" align="left" alt="image" style="
		height: 300px;
		margin: 0px 30px 20px;
		width: 18rem;
		padding: 2px; border-radius:500px;">
	
	<img class="profile-img2" src="img/udit.jpeg" align="left" alt="image" style="
		height: 240px;
		margin: 40px 30px 20px;
		width: 18rem;
		padding: 2px; border-radius:500px;">
	
	<img class="profile-img2" src="img/agam.jpg" align="left" alt="image" style="
		height: 300px;
		margin: 0px 30px 20px 200px;
		width: 18rem;
		padding: 2px; border-radius:500px;">
		 
	</div>
 </div>

	<hr style="top: 20%;position: relative;">
	
	<!-- Footer Function-->
    <footer id="faq" style="position: inherit;background: bisque; top:20%; position:relative;">
      <div class="main-content">
        <div class="left box">
          <h2>About us</h2>
          <div class="content">
            <p>Hey!! This is a quiz website which is built by the students of Delhi 
				and Tongmyong University as a summer internship project. In this website
				you can check your ability in various domains.
            </p>
            <div class="social">
              <a href="#"><span class="fab fa-facebook-f"></span></a>
              <a href="#"><span class="fab fa-twitter"></span></a>
              <a href="#"><span class="fab fa-instagram"></span></a>
              <a href="#"><span class="fab fa-youtube"></span></a>
            </div>
          </div>
        </div>

        <div class="center box">
          <h2>Address</h2>
          <div class="content">
            <div class="place">
              <span class="fas fa-map-marker-alt"></span>
              <span class="text">Delhi , India</span>
            </div>
            <div class="phone">
              <span class="fas fa-phone-alt"></span>
              <span class="text">91- 123456789</span>
            </div>
            <div class="email">
              <span class="fas fa-envelope"></span>
              <span class="text">lpw@example.com</span>
            </div>
          </div>
        </div>

        <div class="right box">
          <h2>Contact us</h2>
          <div class="content">
            <form action="#">
              <div class="email">
                <div class="text">Email *</div>
                <input type="email" required>
              </div>
              <div class="msg">
                <div class="text">Message *</div>
                <input type="text" required>
              </div>
              <div class="btn">
                <button type="submit">Send</button>
              </div>
            </form>
          </div>
        </div>
      </div> 
    </footer>
	
</body>
</html>