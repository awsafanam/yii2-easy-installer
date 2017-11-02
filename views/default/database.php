<?php
	/** @var $model \awsaf\installer\models\DatabaseForm */
	/** @var $success */
?>

<div id="mailer-form" class="card card-accent-secondary">
    <div class="card-header">
		<h2 class="text-center">Database Configuration!</h2>
	</div>
	<div class="card-body">
		<p>Below you have to enter your database connection details. If you’re not sure about these, please contact your
			administrator or web host.</p>

		<?php
			$form = \yii\widgets\ActiveForm::begin([
				                                       'id'                   => 'database-form',
				                                       'enableAjaxValidation' => FALSE,
			                                       ]);
		?>

		<hr/>

		<div class="form-group">
			<?=
				$form->field($model, 'hostname')->textInput([
					                                            'autofocus'    => 'on',
					                                            'autocomplete' => 'off',
					                                            'class'        => 'form-control'
				                                            ])->hint('You should be able to get this info from your web host, if localhost does not work.') ?>
		</div>

		<hr/>

		<div class="form-group">
			<?=
				$form->field($model, 'username')->textInput([
					                                            'autocomplete' => 'off',
					                                            'class'        => 'form-control'
				                                            ])->hint('Your MySQL username') ?>
		</div>

		<hr/>

		<div class="form-group">
			<?=
				$form->field($model, 'password')->passwordInput([
					                                                'class' => 'form-control'
				                                                ])->hint('Your MySQL password') ?>
		</div>

		<hr/>

		<div class="form-group">
			<?=
				$form->field($model, 'database')->textInput([
					                                            'autocomplete' => 'off',
					                                            'class'        => 'form-control'
				                                            ])->hint('The name of the database you want to run your application in.') ?>
		</div>

		<hr/>

		<?php if ($success) { ?>
			<div class="alert alert-success">
				Yes, database connection works!
			</div>
		<?php } elseif (!empty($errorMsg)) { ?>
			<div class="alert alert-danger">
				<strong><?= $errorMsg ?></strong>
			</div>
		<?php } ?>
        <p class="text-right">
            <?= \yii\helpers\Html::submitButton('Next', ['class' => 'btn btn-primary']) ?>
        </p>

		<?php \yii\widgets\ActiveForm::end(); ?>
	</div>
</div>