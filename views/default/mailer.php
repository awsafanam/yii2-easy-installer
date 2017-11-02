<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/** @var $model \awsaf\installer\models\MailerForm */
?>
<div id="mailer-form" class="card card-accent-secondary">
	<div class="card-header">
		<h2 class="text-center">Mailer Configuration!</h2>
	</div>
	<div class="card-body">
		<p>Below you have to enter your mailer details. If you’re not sure about these, please contact your
			administrator or web host.</p>

		<?php
			$form = ActiveForm::begin([ 'id' => 'mailer-form', 'enableAjaxValidation' => FALSE]);
		?>

		<div class="form-group">
			<?=
				$form->field($model, 'host')->textInput([
					                                        'autofocus' => TRUE,
					                                        'autocomplete' => 'off',
					                                        'class'        => 'form-control'
				                                        ])->hint('You should be able to get this info from your web host.') ?>
		</div>

		<hr/>

		<div class="form-group">
			<?=
				$form->field($model, 'username')->textInput([
					                                            'autocomplete' => 'off',
					                                            'class'        => 'form-control'
				                                            ]) ?>
		</div>

		<div class="form-group">
			<?=
				$form->field($model, 'password')->passwordInput([
					                                                'class' => 'form-control'
				                                                ])->hint('Your Email\'s password') ?>
		</div>

		<div class="form-group">
			<?=
				$form->field($model, 'password_confirm')->passwordInput([
					                                                        'class' => 'form-control'
				                                                        ]) ?>
		</div>

		<hr>

		<div class="form-group">
			<?=
				$form->field($model, 'port')->textInput([
					                                        'autocomplete' => 'off',
					                                        'class'        => 'form-control'
				                                        ]) ?>
		</div>

		<div class="form-group">
			<?= $form->field($model, 'encryption')->dropDownList(
				[
					''    => 'Default',
					'ssl' => 'SSL',
					'tls' => 'TLS'
				],
				[
					'class'   => 'form-control',
				]) ?>
		</div>

		<div class="form-group">
			<div class="checkbox">
				<?= $form->field($model, 'useTransport')->checkbox() ?>
			</div>
		</div>

		<hr/>

        <p class="text-right">
            <?= Html::submitButton('Skip (Use Default)', ['name' =>'submit', 'value' =>'skip', 'class' => 'btn btn-info']) ?>
            <?= Html::submitButton('Next', ['name' =>'submit', 'value' =>'save', 'class' => 'btn btn-primary']) ?>
        </p>
		<?php ActiveForm::end(); ?>
	</div>
</div>