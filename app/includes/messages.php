<?php if (isset($_SESSION['message'])) : ?>
	<div class="msg <?php echo $_SESSION['type']; ?>">
		<li><?php echo  $_SESSION['message']; ?></li>
		<?php
		//Una vez hemos mostrado el mensaje, liberamos 
		unset($_SESSION['message']);
		unset($_SESSION['type']);
		?>
	</div>
<?php endif; ?>