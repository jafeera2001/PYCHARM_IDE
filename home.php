<?php
session_start();
$email_id=$_SESSION['email_id'];
$connection=mysqli_connect("localhost:3307","root","","beemail");
$query="select mailid, from_id,subject,body from mails where to_id='$email_id'";
$result=mysqli_query($connection,$query);
?>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
  <script type="text/javascript">
    function loadMail(mailID){
      var form = document.getElementById("mails");
      console.log("before submit");
      document.getElementById("chosenMailId").value = mailID;
      mails.submit();
      console.log("after submit");
    }
  </script>
</head>

<table width="100%" style="height:100%">
<tr>
  <td  align="center" width="15%" style="background:#20c9a0;">
     <div style="height: 20%">
  </div >
  <div style = "height: 80%">
    <table>
    <tr style="height: 85px;">
      <td>
        <form method="POST">
    <input type="submit" class="btn btn-info" value="Compose"><br /><br /><br />
  </form>
  </td>
  </tr>
  <tr>
    <td>
      <table class="table table-hover">
        <tr>
          <td>
            Inbox
          </td>
        </tr>
        <tr>
          <td>
            Outbox
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
  </div>
  </td>
<td align="right" style="width: 85%">
  <div style="height: 20%">
    
    <img src="BeeMail.png" style="max-height: 100%; max-width: 100%;height:120px;width:1800px"/>
  </div >
  <div style = "height: 80%">
<table class="table table-hover table-dark" >
  <thead>
    <tr>
      <th scope="col">From</th>
      <th scope="col">Subject</th>
      
    </tr>
  </thead>
  <tbody>
   <form id="mails" method="POST" action="ViewMail.php">
      <?php
      $user_mails=array();
  while($rows=mysqli_fetch_assoc($result))
  {
    array_push($user_mails,array($rows["mailid"]=>array("from"=>$rows["from_id"],"subject"=>$rows["subject"],"body"=>$rows["body"])));
    
    foreach ($rows as $key => $value) {
      
      if($key == "mailid"){
        echo "<tr>";
    
      }else if($key=="subject")
      {
        echo "<td><b>".$value."</b></td>";
      }
      else
      {
        echo "<td>". $value."</td>";
      }

    }
    echo "</tr>";
  }
  
  $_SESSION['usermails']=$user_mails;
  
  ?>
  <input type="hidden" id="chosenMailId" name="chosenMailId"/ >
</form>
  </tbody>
</table>
</div>
</td>
</tr>
</table>
</html>
<?php

if(isset($_POST['Submit']))
{
  echo "submit panniyachu";
    
  //}
}

?>