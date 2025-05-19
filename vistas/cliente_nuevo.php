<div class="container is-fluid mb-6">
	<h1 class="title">Clientes</h1>
	<h2 class="subtitle">Nuevo Cliente</h2>
</div>
<div class="container pb-6 pt-6">

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/usuario_guardar.php" method="POST" class="FormularioAjax">
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombres</label>
				  	<input class="input" type="text" name="cliente_nombre" maxlength="40" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Apellidos</label>
				  	<input class="input" type="text" name="cliente_apellido" maxlength="40" required >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>DNI</label>
				  	<input class="input" type="text" name="cliente_dni" maxlength="20" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Email</label>
				  	<input class="input" type="email" name="cliente_email" maxlength="70" >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Teléfono</label>
				  	<input class="input" type="txt" name="cliente_telefono" maxlength="100" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Dirección</label>
				  	<input class="input" type="txt" name="cliente_dirección" maxlength="100" required >
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>


