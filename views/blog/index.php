<?php

# Don't change this, i know this is a mess. but trust me, it works.
use Yii as Yii;

?>

<div class="container">
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="5000">
    <div class="carousel-inner" style="height: 600px;">
      <div class="carousel-item active">
        <img src=<?php echo "data:image/jpeg;base64,". base64_encode($posts[0]['picture']) ?> class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="https://www.publicdomainpictures.net/pictures/320000/velka/background-image.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="https://www.w3schools.com/w3css/img_lights.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
<h1>&zwnj;</h1>


<?php foreach ($model as $i) { ?>
<div class="card mb-3" style="max-width: 1000px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <?php
     echo "<img style='object-fit: cover;' class='img-fluid' src='data:image/jpeg;base64,". base64_encode($i['picture']). "' alt='...'>";
     ?>
    </div>
    <div class="col-md-8" style="height: fit-content;">
      <div class="card-body" style="height: auto;">
        <h5 class="card-title"><?= "<a class='card-link' href='/detail/". $i['id'] . "'>". $i['title']. "</a>" ?></h5>
        <p class="card-text"><?= substr($i['content'], 0, 125) ?>...</p>
      </div>
    </div>
  </div>
</div>
<?php echo \yii\widgets\LinkPager::widget([
      'pagination'=>$pagination,
      'activePageCssClass' => 'active'
  ]); ?>
<?php } ?>
</div>

<?php if (!(Yii::$app->user->isGuest)) { ?>
<a href="/create" class="float">
<i class="fa fa-plus my-float"></i>
</a>
<?php } ?>