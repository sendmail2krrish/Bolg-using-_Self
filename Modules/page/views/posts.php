<!DOCTYPE html>
<html lang="en">
<head>
  <title>_Self</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
  <h1>_Self Framework</h1>
  <p>HMVC module based php framework</p> 
</div>
  
<div class="container">
  <div class="row">
    <?php
    foreach($data as $post) {
    ?>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php echo $post->title; ?></h4>
                <p class="card-text"><?php echo $post->content; ?></p>
                <a href="post/<?php echo $post->slug ?>" class="card-link">View more ></a>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
  </div>
</div>

</body>
</html>
