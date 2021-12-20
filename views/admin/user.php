<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
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
            <div class="d-flex">
                <form action="?controller=user&action=delete" method="post">
                        <input type="hidden" name="id" value="<?=$user['id']?>">
                        <button type="submit" class="btn btn-danger">Delete user</button>
                    </form>
            </div>
        </div>
      </nav>
      <h1 class="text-center text-muted mt-3">User page</h1>
      <form class="form" action="?controller=user&action=update" method="post" enctype="multipart/form-data">
      <div class="container d-flex justify-content-start mt-3 p-3">
          <div class="container w-25">
              <div class="row">
                  <div class="col">
                    <img src="<?=$user['img_url'] ? $user['img_url'] : 'https://webstudlab.s3.us-east-2.amazonaws.com/anonuser.png'?>" alt="avatar" width="200px" height="200px">
                  </div>
              </div>
              <div class="row">
                <div class="col">
                <div class="mt-3">
                    <label for="formFile" class="form-label">Upload photo:</label>
                    <input class="form-control" type="file" name="avatar" id="formFile">
                </div>
                </div>
            </div>
          </div>
          <div class="container w-50">
                <input type="hidden" name="id" value="<?=$user['id']?>">
                <div class="row mb-4">
                    <div class="col">
                        <input type="text" class="form-control" id="name" name="name" value="<?=$user['name']?>" aria-describedby="nameInput" placeholder="First name" required>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <input type="text" class="form-control" id="surname" name="surname" value="<?=$user['surname']?>" aria-describedby="surnameInput" placeholder="Last name" required>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <input type="email" class="form-control" id="email" name="email" value="<?=$user['email']?>" aria-describedby="emailInput" placeholder="Email" required>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <input type="password" class="form-control" id="password" name="password" value="<?=$user['password']?>" aria-describedby="passwordInput" placeholder="Password" required>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <select class="form-select" name="role" aria-label="select-role" required>
                        <option selected value="<?=$user['role_id']?>"><?=$role_titles[$user['role_id']]?></option>
                        <?php foreach ($roles as $role):?>
                            <?php if($role['id'] == $user['role_id']):?>
                            <?php else:?>
                                <option value="<?=$role['id']?>"><?=$role['title']?></option>
                            <?php endif;?>
                        <?php endforeach;?>>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                            <button type="submit" class="btn btn-dark">Update</button>
                    </div>
                </div>
          </div>
        </div>
        </form>
        <div class="comments container p-3">
            <h3 class="comments__heading text-muted text-left mt-4">Comments</h3>
            <form class="comments__form form mt-3 text-end" action="?controller=comment&action=add" method="post">
                <input type="hidden" name="author_id" value="<?=$_SESSION['user_id']?>">
                <input type="hidden" name="receiver_id" value="<?=$user['id']?>">
                <textarea class="form-control" placeholder="Write your comment..." name="text" rows="3" style="resize: none;" required></textarea>
                <button type="submit" class="btn btn-outline-dark mt-2">Submit</button>
            </form>
            <div class="container-fluid comments__comments px-0">
                <?php foreach($comments as $comment):?>
                    <div data-comment-id="<?=$comment['id']?>" data-user-id="<?=$user['id']?>" class="comments__comment comment card mt-3 shadow pb-2">
                        <div class="row g-0">
                            <div class="col-2 d-flex justify-content-center align-items-center">
                                <img src="<?=$user['img_url'] ? $user['img_url'] : 'https://webstudlab.s3.us-east-2.amazonaws.com/anonuser.png'?>" alt="avatar" width="100px" height="100px">   
                            </div>
                            <div class="col-10">
                                <div class="card-body">
                                    <h5 class="card-title"><?=$comment['name'] . " " . $comment['surname']?></h5>
                                    <p class="card-text comment__text mb-2"><?=$comment['text']?></p>
                                    <p class="card-text"><small class="text-muted comment__date">
                                        <?=substr($comment['date'], 0, -3)?></small>
                                    </p>
                
                                    <form action="?controller=comment&action=delete" method="post">
                                        <input type="hidden" name="id" value="<?=$comment['id']?>">
                                        <!-- for correct page reloading -->
                                        <input type="hidden" name="user_id" value="<?=$user['id']?>">
                                        <button type="submit" class="comment__delete btn btn-danger btn-sm float-end mb-2">Delete</button>
                                    </form>
                                    <button class="comment__edit btn btn-dark btn-sm float-end mb-2 mx-1">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
                <?php if(!count($comments)):?>
                    <div class="text-secondary mt-5">No comments yet.</div>
                <?php endif;?>
            </div>
        </div>
      </div>
      <script src="../assets/js/EditComment.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>