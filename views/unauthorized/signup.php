<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="/">
              <img src="../logo.png" alt="logo" width="30px" height="30px" class="d-inline-block align-text-top">
              <span class="h4">Website Lab</span>
            </a>
        </div>
      </nav>
      <h1 class="text-center text-muted mt-3">Create a new account</h1>
      <div class="container mt-3 p-3 w-50">
        <form class="form" action="?controller=user&action=add" method="post">
            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="nameInput" placeholder="First name" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control" id="surname" name="surname" aria-describedby="surnameInput" placeholder="Last name" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <?php if (!isset($error)):?>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailInput" placeholder="Email" required>
                    <?php else:?>
                        <input type="email" class="form-control is-invalid" id="email" name="email" aria-describedby="emailInput" placeholder="Email" required>
                           <div class="invalid-feedback">
                               <?= $error ?>
                           </div> 
                    <?php endif;?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordInput" placeholder="Password" required>
                    <div class='invalid-feedback d-none invalid-password'>Password should have at least 6 symbols.</div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <input type="password" class="form-control" id="pwdCheck" aria-describedby="pwdCheckInput" placeholder="Repeat password" required>
                    <div class='invalid-feedback d-none same-password'>Passwords don`t match.</div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <select class="form-select" aria-label="select-role" name="role" required>
                        <option selected disabled value="">Select role</option>
                        <?php foreach ($roles as $role):?>
                        <option value="<?=$role['id']?>"><?=$role['title']?></option>
                        <?php endforeach;?>
                      </select>
                </div>
            </div>
            <button type="submit" id="submit-btn" class="btn btn-outline-dark mt-3 float-end">Sign up</button>
        </form>
      </div>
      <script src="../assets/js/SignUpValidation.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>