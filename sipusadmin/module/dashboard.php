<?php  
	error_reporting(E_ALL^E_NOTICE);
?>
<!-- module Dashboard -->
<div class="col-xs-12">
	<div class="box box-default">
		<div class="box-body">
			<div class="callout callout-info">
				<h2> Hallo, <?php echo ucwords($_SESSION['username']) ?></h2>
				<p>Selamat Datang di panel SIPUS AMIK YMI Tegal</p>
			</div>
		</div>
	</div>
</div>