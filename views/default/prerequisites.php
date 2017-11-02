<?php
	/** @var $checks \app\helpers\SystemCheck */
	/** @var $hasError \app\helpers\SystemCheck */
?>
<div id="mailer-form" class="card card-accent-secondary">
	<div class="card-header">
		<h2 class="text-center">System Check</h2>
	</div>

	<div class="card-body">
		<p>In the following overview, you can see, if all the requirements are ready.</p>
		<hr/>

		<div class="prerequisites-list">
			<ul>
				<?php foreach ($checks as $check) {
					?>
					<li>
						<?php if ($check['state'] == 'OK') {
							?>
							<i class="fa fa-check-circle check-ok animated bounceIn"></i>
						<?php
						} elseif ($check['state'] == 'WARNING') {
							?>
							<i class="fa fa-exclamation-triangle check-warning animated swing"></i>
						<?php
						} elseif ($check['state'] == 'ERROR') {
							?>
							<i class="fa fa-minus-circle check-error animated wobble"></i>
						<?php
						} ?>

						<strong><?= $check['title']; ?></strong>

						<?php if (isset($check['hint'])) { ?>
							<span>(Hint: <?= $check['hint']; ?>)</span>
						<?php } ?>
					</li>
				<?php
				} ?>
			</ul>
		</div>

		<?php if (!$hasError) {
			?>
			<div class="alert alert-success">
				Congratulations! Everything is ok and ready to start over!
			</div>
		<?php
		} ?>
		<hr/>
        <div class="row">
            <div class="col-6">
                <?= \yii\helpers\Html::a('<i class="fa fa-repeat"></i> ' . 'Check again', ['//installer/default/prerequisites'], ['class' => 'btn btn-info']) ?>
            </div>
            <div class="col-6">
                <?php if (!$hasError) { ?>
                    <p class="text-right">
                        <?= \yii\helpers\Html::a('Next' . ' <i class="fa fa-arrow-circle-right"></i>', ['//installer/default/database'], ['class' => 'btn btn-primary']) ?>
                    </p>
                <?php } ?>
            </div>
        </div>
	</div>
</div>