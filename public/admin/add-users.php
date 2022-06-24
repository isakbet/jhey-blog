<?php
require('./src/config.php');
$pageTitle = 'Create User';
$pageId = 'create';
// debug($_POST);

$fname  = '';
$lname   = '';
$phone       = '';
$street      = '';
$postal_code = '';
$city        = '';
$country     = '';
$username    = '';
$email       = '';
$error       = '';
$msg         = '';
$status      = '';

if (isset($_POST['createUserBtn'])) {
  $username          = trim($_POST['username']);
  $fname             = trim($_POST['fname']);
  $lname             = trim($_POST['lname']);
  $email             = trim($_POST['email']);
  $password          = trim($_POST['password']);
  $confirmPassword   = trim($_POST['confirmPassword']);
  $phone             = trim($_POST['phone']);              



  if (empty($fname)) {
    $error .= "<li>The first name is mandatory</li>";
  }

  if (empty($lname)) {
    $error .= "<li>The last name is mandatory</li>";
  }

  if (empty($email)) {
    $error .= "<li>The e-mail address is mandatory</li>";
  }

  if (empty($password)) {
    $error .= "<li>The password is mandatory</li>";
  }

  if (empty($phone)) {
    $error .= "<li>The phone is mandatory</li>";
  }

  if (empty($street)) {
    $error .= "<li>The street is mandatory</li>";
  }

  if (empty($postal_code)) {
    $error .= "<li>The postal code is mandatory</li>";
  }

  if (empty($city)) {
    $error .= "<li>The city is mandatory</li>";
  }

  if (empty($country)) {
    $error .= "<li>The country is mandatory</li>";
  }

  if (!empty($password) && strlen($password) < 6) {
    $error .= "<li>The password cant be less than 6 characters</li>";
  }

  if ($confirmPassword !== $password) {
    $error .= "<li>The confirmed password does not match</li>";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error .= "<li>Unvalid e-mail address</li>";
  }

  if ($error) {
    $msg = "<div class='alert alert-danger alert-dismissible d-flex align-items-center fade show'>
            <i class='bi-check-circle-fill'></i><ul>{$error}</ul>
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
  }

  if (empty($error)) {
    $userData = [
      'username'      => $username,
      'fname'         => $fname,
      'lname'         => $last_name,
      'password'      => $password,
      'email'         => $email,
      'phone'         => $phone,
      'street'        => $street,
      'postal_code'   => $postal_code,
      'city'          => $city,
      'country'       => $country,
    ];

    $result = ($userData);

    if ($result) {
      $userDbHandler->addUser(
        $username,
        $fname,
        $lname,
        $email,
        $password,
        $phone,
        $street,
        $postal_code,
        $city,
        $country
      );
      $msg =  '<div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
                <i class="bi-check-circle-fill"></i>
                <strong class="mx-2">Success!</strong> The user was successfully created.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            ';
    } else {
      $msg = '<div class="alert alert-danger" role="alert">Failed to create a user. Please try again.</div>';
    }
  }
}

?>


<div id="content">

  <?= $msg ?>


  <table class="table">
    <form method="POST" action="#">
      <tr>
        <td>
          <label for="input1">Username:</label><br>
          <input type="text" class="text form-control" name="username" value="<?= htmlentities($username) ?>">
        </td>
        <td>
          <label for="input2">E-mail address:</label><br>
          <input type="text" class="text form-control" name="email" value="<?= htmlentities($email) ?>">
        </td>

      </tr>
      <tr>
        <td>
          <label for="input3">Password:</label><br>
          <input type="password" class="text form-control" name="password">
        </td>

        <td>
          <label for="input4">Confirm Password:</label><br>
          <input type="password" class="text form-control" name="confirmPassword">
        </td>
      </tr>
      <tr>
        <td>
          <label for="input5">First name:</label><br>
          <input type="text" class="text form-control" name="first_name" value="<?= htmlentities($fname) ?>">
        </td>
        <td>
          <label for="input6">Last name:</label><br>
          <input type="text" class="text form-control" name="last_name" value="<?= htmlentities($lname) ?>">
        </td>
      </tr>
      <tr>
        <td>
          <label for="input7">Phone:</label><br>
          <input type="text" class="text form-control" name="phone" value="<?= htmlentities($phone) ?>">
        </td>
        <td>
          <label for="input8">Street:</label><br>
          <input type="text" class="text form-control" name="street" value="<?= htmlentities($street) ?>">
        </td>
      </tr>
      <tr>
        <td>
          <label for="input9">City</label><br>
          <input type="text" class="text form-control" name="city" value="<?= htmlentities($city) ?>">
        </td>

        <td>
          <label for="input7">Postal code</label><br>
          <input type="text" class="text form-control" name="postal_code" value="<?= htmlentities($postal_code) ?>">
        </td>
      </tr>
      <tr>
        <td>
          <label for="country">Country</label><br>
          <input type="text" class="text form-control" name="country" value="<?= htmlentities($country) ?>">
        </td>
      </tr>
      <br>
      <tr>
        <td id="user">
          <input type="submit" name="createUserBtn" value="Create" class="btn btn-dark text-light mt-4 d-block">
        </td>
      <tr>
  </table>
  </form>
  <a href="manage-users.php"><i class="fas fa-angle-left"></i>Back</a>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</body>

</html>


<?php include 'layout/footer.php'; ?>