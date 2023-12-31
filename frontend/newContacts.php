<?php
  session_start();  
  require_once '../database/config.php';
 if (isset($_POST['email'])) {
   // Sanitize user input
   $title = strip_tags($_POST['title']);
   $fname = strip_tags($_POST['fname']);
   $lname = strip_tags($_POST['lname']);
   $email = strip_tags($_POST['email']);
   $telNum = strip_tags($_POST['telNum']);
   $company =strip_tags($_POST['company']);
   $type = strip_tags($_POST['type']);
   $assigned = (int)strip_tags($_POST['role']);


  
  

   // Prepare an insert statement
   $stmt = $link->prepare("INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
   $stmt->bind_param("sssssssii", $title,$fname, $lname, $email, $telNum, $company, $type, $assigned, $_SESSION['id']);

   // Attempt to execute the prepared statement
   if ($stmt->execute()) {
       echo "New user created successfully";
   } else {
       echo "Error: " . $stmt->error;
   }

   // Close statement
   $stmt->close();
 }


?>


<div class="dash-top"> 
  <h2>New Contact</h2>
</div>
<div class="content">
  <form action="#" method="post">
  <div class="input-containers">
      <label class="input-labels" for="title">Title</label>
      <select name="title" name="title" required>
        <option value="Mr.">Mr.</option>
        <option value="Ms.">Ms.</option>
        <option value="Mrs.">Mrs.</option>
      </select>
    </div>
    <div class="input-containers">
      <label class="input-labels" for="fname">First Name</label>
      <input id="fname" type="text" placeholder="Jane" name="fname" autocomplete="on" required>
    </div>
    <div class="input-containers">
      <label class="input-labels" for="lname">Last Name</label>
      <input id="lname" type="text" placeholder="Doe" name="lname" autocomplete="on" required>
    </div>
    <div class="input-containers">
      <label class="input-labels" for="email">Email</label>
      <input id="email" type="email" placeholder="dummyemail@example.com" name="email" autocomplete="on" required>
    </div>
    <div class="input-containers">
      <label class="input-labels" for="telNum">Telephone</label>
      <input id="telNum" type="tel" name="telNum" placeholder="e.g. 876-999-1234" autocomplete="on" required pattern="^\d{3}-\d{3}-\d{4}$" title="876-999-1234">
    </div>
    <div class="input-containers">
      <label class="input-labels" for="company">Company</label>
      <input id="company" type="text" placeholder="" name="company" autocomplete="on" required>
    </div>
    <div class="input-containers">
      <label class="input-labels" for="type">Type</label>
      <select name="type" name="type" required>
        <option value="SALES LEAD">Sales Lead</option>
        <option value="SUPPORT">Support</option>
      </select>
    </div>
    <div class="input-containers">
      <label class="input-labels" for="role">Assigned To</label>
     
      <select name="role" name="role" required>
        <option value="Select">Select Option</option>
        <?php 
        if ($result = mysqli_query($link, "SELECT * FROM Users")){
          if (mysqli_num_rows($result) > 0){
            while ($user = mysqli_fetch_array($result)){
              echo "<option value ='".$user['id']."'>".$user['firstname'] ." ".$user['lastname']."</option>";
         
            }
            mysqli_free_result($result);
          }else{
            echo "<option value =''>NO USERS</option>";
          }          
        }else{
          echo "ERROR: Could not able to execute quert. " . mysqli_error($link);
        }
        $link->close();
      ?>
      </select>
    </div>
    <input type="submit" name="submit" class="form-submit" value="Save">
  </form>
</div>



 