<div class="container">
  <div>
    <div class="row" style="margin-left: 2px;">
      <h1><?php echo $items['title'] ?></h1>
      <a style="margin-left: 5px;font-size: 30px;" href="<?= '/edit/'. $items['id'] ?>"><i class="fas fa-edit"></i></a>
      <a style="margin-left: auto;margin-top:auto;font-size: 30px;" href="<?= '/delete/'. $items['id'] ?>"><i class="fas fa-trash"></i></a>
    </div>
    <hr/>
    <?php
    echo "<img class='img-fluid' style='max-height:400px' src='data:image/jpeg;base64,". base64_encode($items['picture']). "' alt='...'>";
    ?>
    <div style="margin-top: 30px; margin-right: 200px;">
      <p><?= $items['content'] ?></p>
    </div>
  </div>
</div>
