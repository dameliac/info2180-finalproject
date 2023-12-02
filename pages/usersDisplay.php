<div class="dash-top"> 
  <h2>Users</h2>
  <button class="add-button"><img src="/docs/Plus.svg" alt=""> Add User</button>
</div>
<div class="content">
<?php 
require_once "../database/config.php";
$sql = "SELECT firstname, lastname, email, role FROM Users";
echo '<table cellspacing="0">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th></th>
          </tr>
        </thead>
        <tbody>';

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td class='name-highlight'>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td><p class='" . strtolower($row['role']) . "'>" . strtoupper($row['role']) . "</p></td>";
                echo "<td><a href=''>View</a></td>";
            echo "</tr>";
        }
        mysqli_free_result($result);
    } else{
        echo "<tr><td colspan='4'>No users found</td></tr>";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

echo '</tbody></table>';
?>
</div>