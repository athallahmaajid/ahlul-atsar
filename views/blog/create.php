<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Create Post';
?>
<script src="js/medium-editor.js"></script>
<div class="container">
    <div class="site-login">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
            'options' => ['enctype'=>'multipart/form-data']
        ]);
        ?>

            <?= $form->field($model, 'picture')->fileInput(['multiple' => false, 'accept' => 'image/*']) ?>

            <?= $form->field($model, 'title')->textInput() ?>

            <?= $form->field($model, 'content')->textArea(['class' => 'editable', 'rows' => 6, 'cols' => "50"]) ?>

            <?= $form->field($model, 'category')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
            <p><?= $error ?></p>

        <?php ActiveForm::end(); ?>
    </div>
</div>
<script>var editor = new MediumEditor('.editable', {autoLink:true});</script>
