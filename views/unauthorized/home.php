<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/favicon.ico"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Home</title>
    <?php if (array_key_exists('error_signin', $errors)):?>
        <script defer src="../assets/js/ModalTrigger.js"></script>
    <?php endif;?>
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
              <img src="../logo.png" alt="logo" width="30px" height="30px" class="d-inline-block align-text-top">
              <span class="h4">Website Lab</span>
            </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link border-end border-danger" data-bs-toggle="modal" data-bs-target="#signin-modal" href="#">Sign in</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?action=signup">Sign up</a>
              </li>
            </ul>
            <form class="d-flex">
            <input class="form-control me-2 search-bar" type="search" placeholder="Search user" aria-label="Search">
            </form>
          </div>
        </div>
      </nav>
      <h1 class="text-center text-muted mt-3">Home</h1>
      <div class="container bg-dark mt-4 text-white users">
        <div class="row h6 users__header">
          <div class="col p-2 border-end border-2 border-danger">
            ???
          </div>
          <div class="col-2 p-2 border-end border-2 border-danger">
            Avatar
          </div>
          <div class="col-2 p-2 border-end border-2 border-danger">
            Name
          </div>
          <div class="col-2 p-2 border-end border-2 border-danger">
            Surname
          </div>
          <div class="col-3 p-2 border-end border-2 border-danger">
            Email
          </div>
          <div class="col-2 p-2">
            Role
          </div>
        </div>
        <?php for ($i = 0; $i < count($users); $i++):?>
        <div data-search="<?=$users[$i]['name']?> <?=$users[$i]['surname']?>"  class="row border users__user">
            <div class="col p-2 bg-light text-dark border-end text-center">
            <a href="?controller=user&id=<?=$users[$i]['id']?>"><?=$i + 1?></a>
          </div>
          <div class="col-2 p-2 bg-light text-dark border-end text-center">
          <img src="<?=$users[$i]['img_url'] ? $users[$i]['img_url'] : 'https://webstudlab.s3.us-east-2.amazonaws.com/anonuser.png'?>" alt="avatar" width="100px" height="100px">
          </div>
          <div class="col-2 p-2 bg-light text-dark border-end">
            <?=$users[$i]['name']?>
          </div>
          <div class="col-2 p-2 bg-light text-dark border-end">
            <?=$users[$i]['surname']?>
          </div>
          <div class="col-3 p-2 bg-light text-dark border-end">
            <?=$users[$i]['email']?>
          </div>
          <div class="col-2 p-2 bg-light text-dark border-end">
            <?=$users[$i]['title']?>
          </div>
        </div>
        <?php endfor;?>
        </div>
      </div>
      <div class="modal fade"  id="signin-modal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Sign in</h5>
          </div>
          <form class="singin-form form" action="?action=signin" method="post">
          <div class="modal-body">
              <div class="row mb-3">
                <div class="col">
                  <?php if(array_key_exists('error_signin', $errors)):?>
                    <input type="email" class="form-control is-invalid" id="email" name="email" aria-describedby="emailInput" placeholder="Email">
                  <?php else:?>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailInput" placeholder="Email">
                  <?php endif;?>  
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                  <?php if(array_key_exists('error_signin', $errors)):?>
                    <input type="password" class="form-control is-invalid" id="password" name="password" aria-describedby="passwordInput" placeholder="Password">
                    <div class="invalid-feedback">
                      <?=$errors['error_signin']?>
                    </div>
                  <?php else:?>
                    <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordInput" placeholder="Password">
                  <?php endif;?>  
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Back</button>
            <button type="submit" class="btn btn-dark">Submit</button>
      </div>
    </form>
    </div>
      <script src="../assets/js/Searching.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>