<?php 

/*
DIV que se incluiá para mostrar mensajes de éxito o de error en determinadas
zonas de la web: en el index al loguearse, o en el panel de administrador al realizar
cualquier acción de administración de usuarios, posts, topics o comentarios.

Una vez hemos mostrado el mensaje, liberamos el mensjae y el tipo (éste será o 
"error" o "success" para darle un estilo rojo (error) o verde (éxito) dependiendo
de la acción que hayamos relizado.
*/
if (isset($_SESSION['message'])) : ?>
	<div class="msg <?php echo $_SESSION['type']; ?>">
		<li><?php echo  $_SESSION['message']; ?></li>
		<?php
		unset($_SESSION['message']);
		unset($_SESSION['type']);
		?>
	</div>
<?php endif; ?>