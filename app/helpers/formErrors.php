<!-- DIV para mostrar un mensaje de error del formulario.
Le damos las clases .msg y .error para darle estilo, y
un bucle ForEach para recorrer el array de errores y mostrar
todos los que haya. -->

<?php if(count($errors) > 0) : ?>
	<div class="msg error">
<?php foreach ($errors as $error) : ?>
<li><?php echo "• $error"?></li>
<?php endforeach; ?>
</div>
<?php endif; ?>