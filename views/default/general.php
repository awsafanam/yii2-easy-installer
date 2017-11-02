<?php
	/** @var $model \awsaf\installer\models\DatabaseForm */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/** @var $success */
?>

<div id="mailer-form" class="card card-accent-secondary">
    <div class="card-header">
        General Configuration!
	</div>
	<div class="card-body">

		<?php
			$form = ActiveForm::begin([ 'id'=> 'database-form']);
		?>

		<hr/>

		<div class="form-group">
			<?=
				$form->field($model, 'adminEmail')->textInput([
					                                            'autofocus'    => 'on',
					                                            'class'        => 'form-control'
				                                            ])->hint('The default email to be used to send emails.') ?>
		</div>

		<hr/>

        <p class="text-right">
            <?= Html::submitButton('Next', ['class' => 'btn btn-primary']) ?>
        </p>

		<?php ActiveForm::end(); ?>
	</div>
</div>