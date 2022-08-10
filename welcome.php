<?php
    include_once 'database.php';
    session_start();
    if(!(isset($_SESSION['email'])))
    {
        header("location:index.php");
    }
    else
    {
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        include_once 'database.php';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome | Online Quiz System</title>
    <link  rel="stylesheet" href="css/bootstrap.min.css"/>
    <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
    <link rel="stylesheet" href="css/welcome.css">
	
	<link rel="stylesheet" href="./Script/CSS/style1.css">
	
    <link  rel="stylesheet" href="css/font.css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"  type="text/javascript"></script>
</head>
<body style="background-color:bisque">
    <nav class="navbar navbar-default title1">
        <div class="container-fluid">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        <a class="navbar-brand" href="#"><b>Online Quiz System</b></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-left">
			<li <?php if(@$_GET['q']==0) echo'class="active"'; ?>> <a href="welcome.php?q=0"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home<span class="sr-only">(current)</span></a></li>
            <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>> <a href="welcome.php?q=1"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Dashboard<span class="sr-only"></span></a></li>
            <li <?php if(@$_GET['q']==2) echo'class="active"'; ?>> <a href="welcome.php?q=2"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;History</a></li>
            <li <?php if(@$_GET['q']==3) echo'class="active"'; ?>> <a href="welcome.php?q=3"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>&nbsp;Ranking</a></li>
            
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <li <?php echo''; ?> > <a href="logout.php?q=index.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Log out</a></li>
        </ul> 
        </div>
    </div>
    </nav>
	
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
				<?php if(@$_GET['q']==0)
                {
                   echo '<h1> WELCOME TO Online Quiz Page!!
					</h1>
					<div class="container1" style="top:16%;font-size:18px;"; >
					  <p text-algin="left" class="name" style="font-size:18px;">About Quiz / General Instruction </p>
					   <img class="profile-img1" src="img/quiz.jpg" 
						style="height:20rem;border-radius:20px;width:35rem;clip-path:circle" align="right" alt="Quiz_image">
						
						1) The quizzes consists of questions carefully designed to help you self-assess your 
						comprehension of the information presented on the topics shown on the page. <br>
						2) No data will be collected on the website regarding your responses or how many times you take the quiz.<br>
						3) Each question in the quiz is of single-choice format.Read each question carefully <br>
						4) Each correct or incorrect response will result in appropriate feedback at last of quiz<br>
						5) After responding to a question, click on the "Submit" button at the bottom to go to the next questinon. <br>
						6) After responding to the 5th question,click on "submit" on the window to exit the quiz. <br>
						7) If you select an incorrect response for a question, you can try again until you get the correct response.
						   If you retake the quiz, the questions and their respective responses will be randomized.
						   The total score for the quiz is based on your responses to all questions. <br>
						8) However, your quiz will not be graded, if you skip a question or exit before responding to all the questions.</p>
					    </p>
					</div>';
					
                }
				?>
                <?php if(@$_GET['q']==1) 
                {
                    $result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
                    echo  '
					<div class="panel" style="border-radius: 50px">
					<div class="table-responsive">
					<table class="table table-striped title1">
                    <tr>
						<td><center><b>S.N.</b></center></td>
						<td><center><b>Topic</b></center></td>
						<td><center><b>Total question</b></center></td>
						<td><center><b>Marks</center></b></td>
						<td><center><b>Action</b></center></td>
					</tr>';
                    $c=1;
                    while($row = mysqli_fetch_array($result)) {
                        $title = $row['title'];
                        $total = $row['total'];
                        $sahi = $row['sahi'];
                        $eid = $row['eid'];
                    $q12=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
                    $rowcount=mysqli_num_rows($q12);	
                    if($rowcount == 0){
                        echo '
						<tr>
							<td><center>'.$c++.'</center></td>
							<td><center>'.$title.'</center></td>
							<td><center>'.$total.'</center></td>
							<td><center>'.$sahi*$total.'</center></td>
							<td><center><b><a href="welcome.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" class="btn sub1" style="color:black;margin:0px;background:#1de9b6">
							<span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></b></center></td></tr>';
                    }
                    else
                    {
                    echo '
					<tr style="color:#99cc32">
						<td><center>'.$c++.'</center></td>
						<td><center>'.$title.'&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></center></td>
						<td><center>'.$total.'</center></td>
						<td><center>'.$sahi*$total.'</center></td>
						<td><center><b><a href="update.php?q=quizre&step=25&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="color:black;margin:0px;background:red">
						<span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>&nbsp;<span class="title1">
						<b>Restart</b></span></a></b></center></td>
					</tr>';
                    }
                    }
                    $c=0;
                    echo '</table></div></div>';
                }?>

                <?php
                    if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) 
                    {
                        $eid=@$_GET['eid'];
                        $sn=@$_GET['n'];
                        $total=@$_GET['t'];
                        $q=mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' " );
                        echo '<div class="panel" style="border-radius: 20px;margin: 0px auto;max-width: 550px; margin-top:8%">';
                        while($row=mysqli_fetch_array($q) )
                        {
                            $qns=$row['qns'];
                            $qid=$row['qid'];
                            echo '<b>Question &nbsp;'.$sn.'&nbsp;::<br /><br />'.$qns.'</b><br /><br />';
                        }
                        $q=mysqli_query($con,"SELECT * FROM options WHERE qid='$qid' " );
                        echo '<form action="update.php?q=quiz&step=2&eid='.$eid.'&n='.$sn.'&t='.$total.'&qid='.$qid.'" method="POST"  class="form-horizontal">
                        <br />';

                        while($row=mysqli_fetch_array($q) )
                        {
                            $option=$row['option'];
                            $optionid=$row['optionid'];
                            echo'<input type="radio" name="ans" value="'.$optionid.'">&nbsp;'.$option.'<br /><br />';
                        }
                        echo'<br />
						<button type="submit" class="btn btn-primary">
						<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
                    }

                    if(@$_GET['q']== 'result' && @$_GET['eid']) 
                    {
                        $eid=@$_GET['eid'];
                        $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error157');
                        echo  '<div class="panel">
                        <center>
							<h1 class="title" style="color:#660033">Result</h1>
						<center><br/>
						<table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';
                        while($row=mysqli_fetch_array($q) )
                        {
                            $s=$row['score'];
                            $w=$row['wrong'];
                            $r=$row['sahi'];
                            $qa=$row['level'];
                            echo '<tr style="color:#66CCFF">
								<td>Total Questions</td><td>'.$qa.'</td></tr>
                                <tr style="color:#99cc32">
								<td>Right Answer&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td>'.$r.'</td></tr> 
                                <tr style="color:red">
								<td>Wrong Answer&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td>'.$w.'</td></tr>
                                <tr style="color:#66CCFF">
								<td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
                        }
                        $q=mysqli_query($con,"SELECT * FROM rank WHERE  email='$email' " )or die('Error157');
                        while($row=mysqli_fetch_array($q) )
                        {
                            $s=$row['score'];
                            echo '
							<tr style="color:#990000">
								<td>Overall Score&nbsp;<span class="glyphicon glyphicon-stats" aria-hidden="true"></span></td>
								<td>'.$s.'</td>
							</tr>';
                        }
                        echo '</table></div>';
                    }
                ?>

                <?php
                    if(@$_GET['q']== 2) 
                    {
                        $q=mysqli_query($con,"SELECT * FROM history WHERE email='$email' ORDER BY date DESC " )or die('Error197');
                        echo  '<div class="panel title">
                        <table class="table table-striped title1" >
                        <tr style="color:black;">
							<td><center><b>S.N.</b></center></td>
							<td><center><b>Quiz</b></center></td>
							<td><center><b>Question Solved</b></center></td>
							<td><center><b>Right</b></center></td>
							<td><center><b>Wrong<b></center></td>
							<td><center><b>Score</b></center></td>';
                        $c=0;
                        while($row=mysqli_fetch_array($q) )
                        {
                        $eid=$row['eid'];
                        $s=$row['score'];
                        $w=$row['wrong'];
                        $r=$row['sahi'];
                        $qa=$row['level'];
                        $q23=mysqli_query($con,"SELECT title FROM quiz WHERE  eid='$eid' " )or die('Error208');

                        while($row=mysqli_fetch_array($q23) )
                        {  $title=$row['title'];  }
                        $c++;
                        echo '
						<tr>
							<td><center>'.$c.'</center></td>
							<td><center>'.$title.'</center></td>
							<td><center>'.$qa.'</center></td>
							<td><center>'.$r.'</center></td>
							<td><center>'.$w.'</center></td>
							<td><center>'.$s.'</center></td>
						</tr>';
                        }
                        echo'</table></div>';
                    }

                    if(@$_GET['q']== 3) 
                    {
                        $q=mysqli_query($con,"SELECT * FROM rank ORDER BY score DESC " )or die('Error223');
                        echo  '<div class="panel title"><div class="table-responsive">
                        <table class="table table-striped title1" >
                        <tr style="color:red">
							<td><center><b>Rank</b></center></td>
							<td><center><b>Name</b></center></td>
							<td><center><b>Email</b></center></td>
							<td><center><b>Score</b></center></td>
						</tr>';
                        $c=0;

                        while($row=mysqli_fetch_array($q) )
                        {
                            $e=$row['email'];
                            $s=$row['score'];
                            $q12=mysqli_query($con,"SELECT * FROM user WHERE email='$e' " )or die('Error231');
                            while($row=mysqli_fetch_array($q12) )
                            {
                                $name=$row['name'];
                            }
                            $c++;
                            echo '
							<tr>
								<td style="color:black"><center><b>'.$c.'</b></center></td>
								<td><center>'.$name.'</center></td>
								<td><center>'.$e.'</center></td>
								<td><center>'.$s.'</center></td>
							</tr>';
                        }
                        echo '</table></div></div>';
                    }
                ?>
	<div class="Welcome1" style="height: 55px;">
		<br>
		<marquee behavior="scroll"; direction="left"; scrollamount="12"> 
		<h1 style="font-size: 20px; margin: -3px;" >This is Online QUIZ Site TU AND DU</h1> </marquee>
		<br>
	</div>
</body>
</html>