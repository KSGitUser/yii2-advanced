<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\tables\Users;
use yii\helpers\Url;
use frontend\assets\TaskOneAsset;

TaskOneAsset::register($this);


/* @var $this yii\web\View */
/* @var $model common\models\tables\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'responsible_id')->dropDownList($array, ['prompt'=>'Select username',]); ?>


    <?= $form->field($model, 'date')->widget(\yii\widgets\MaskedInput::className(), [ 'mask' => '9999/99/99',]); ?>

    <?= $form->field($model, 'status_id')->textInput() ?>
    <?= $this->render('@app/views/upload/index.php', ['model' => $imageModel, 'form' => $form]) ?>

     <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div class="form_comments">
    <h3>Комментарии</h3>
    <?php $formComments = ActiveForm::begin(['action' => Url::to(['tasks/add-comment'])]);?>
    <?= $formComments->field($taskCommentForm, 'user_id')->hiddenInput(['value' => $userId])->label(false);?>
    <?= $formComments->field($taskCommentForm, 'task_id')->hiddenInput(['value' => $model->id])->label(false); ?>
    <?= $formComments->field($taskCommentForm, 'comment')->textInput(); ?>
    <?= Html::submitButton("Add", ['class' => 'btn btn-default']); ?>
    <?ActiveForm::end() ?>
    <hr>
    <div class="comment-history">
        <?foreach ($model->comments as $comment): ?>
            <p><strong><?= $comment->user->username?></strong>: <?= $comment->comment ?> </p>
        <?php endforeach;?>
    </div> 
    <h3>Чат</h3>
    <div class="task-chat">
        <form action="#" name="chat_form" id="chat_form">
         <label>
            <input type="hidden" name="channel" value="<?=$channel?>" />
            <input type="hidden" name="user_id" value="<?=$userId?>" /> 
            Введите сообщение
            <input type="text" name="message" />
            <input type="submit" />
        </label>
        </form>
        <hr>
        <div class="chat"></div>
    


    </div> 
</div>
<script>
    const channel = '<?=$channel?>'
</script>



</div>
