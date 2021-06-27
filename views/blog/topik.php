

<div class="container">
<h1>Topik: <?= $topik ?></h1>
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
<?php } ?>
</div>
</div>
