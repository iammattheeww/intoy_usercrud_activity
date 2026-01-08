<h3>Provide the Required Information</h3>
<div id="form-block">
  <form method="POST" action="processes/process.user.php?action=update">
    <div id="form-block-half">
      <label for="fname">First Name</label>
      <input type="text" id="fname" class="input" name="firstname" value="<?php echo $user->get_user_firstname($id); ?>" placeholder="Your name..">

      <label for="lname">Last Name</label>
      <input type="text" id="lname" class="input" name="lastname" value="<?php echo $user->get_user_lastname($id); ?>" placeholder="Your last name..">

      <label for="access">Access Level</label>
      <select id="access" name="access">
        <option value="staff" <?php if ($user->get_user_access($id) == "Staff") {
                                echo "selected";
                              }; ?>>Staff</option>
        <option value="supervisor" <?php if ($user->get_user_access($id) == "Supervisor") {
                                      echo "selected";
                                    }; ?>>Supervisor</option>
        <option value="Manager" <?php if ($user->get_user_access($id) == "Manager") {
                                  echo "selected";
                                }; ?>>Manager</option>
      </select>
    </div>
    <div id="form-block-half">
      <label for="status">Account Status</label>
      <select id="status" name="status">
        <option value="0" <?php if ($user->get_user_status($id) == "0") {
                  echo "selected";
                }; ?>>Deactivated</option>
        <option value="1" <?php if ($user->get_user_status($id) == "1") {
                  echo "selected";
                }; ?>>Active</option>
      </select>
      <label for="email">Email</label>
      <input type="email" id="email" class="input" name="email" value="<?php echo $user->get_user_email($id); ?>" placeholder="Your email..">
      <!-- Update: Password input -->
      <label for="password">Password (leave blank to keep current)</label>
      <input type="password" id="password" class="input" name="password" placeholder="New password..">

      <input type="hidden" id="userid" name="userid" value="<?php echo $id; ?>" />
    </div>
    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
    <div id="button-block">
      <input type="submit" value="Update">
    </div>
  </form>
      <a href="#">Change Email</a> |
      <a href="#">Change Password</a> |

      <!-- Separate form for the deactivate or activate actions -->
      <form method="POST" action="processes/process.user.php?action=deactivate" style="display:inline;">
        <input type="hidden" name="userid" value="<?php echo $id; ?>" />
        <?php
        if ($user->get_user_status($id) == "1") {
          echo '<input type="submit" value="Disable Account">';  // Button to disable if active
        } else {
          echo '<input type="submit" value="Activate Account">';  // Button to activate if inactive
        }
        ?>
      </form>

      <!-- Separate form for the delete action with confirmation -->
      <form method="POST" action="processes/process.user.php?action=delete" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
        <input type="hidden" name="userid" value="<?php echo $id; ?>" />
        <input type="submit" value="Delete User" style="background-color: red; color: white;">
      </form>
</div>
