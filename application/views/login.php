<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/12/2019
 * Time: 7:56 PM
 */
?>

<div class="container center-content">
	<form action="" method="post">
		<div class="form-group">
			<label for="password">Hasło</label>
			<input id="pin" type="number" class="form-control" name="pin" placeholder="PIN">
		</div>
		<div class="text-center">
			<button type="submit" class="btn btn-lg btn-primary">Zaloguj się</button>
		</div>
	</form>
	<div class="row d-none d-md-flex">
		<div class="col-4 text-center">
			<div class="py-2">
				<button onclick="appendPin(7)" class="btn btn-lg btn-primary">7</button>
			</div>
			<div class="py-2">
				<button onclick="appendPin(4)" class="btn btn-lg btn-primary">4</button>
			</div>
			<div class="py-2">
				<button onclick="appendPin(1)" class="btn btn-lg btn-primary">1</button>
			</div>
		</div>
		<div class="col-4 text-center">
			<div class="py-2">
				<button onclick="appendPin(8)" class="btn btn-lg btn-primary">8</button>
			</div>
			<div class="py-2">
				<button onclick="appendPin(5)" class="btn btn-lg btn-primary">5</button>
			</div>
			<div class="py-2">
				<button onclick="appendPin(2)" class="btn btn-lg btn-primary">2</button>
			</div>
			<div class="py-2">
				<button onclick="appendPin(0)" class="btn btn-lg btn-primary">0</button>
			</div>
		</div>
		<div class="col-4 text-center">
			<div class="py-2">
				<button onclick="appendPin(9)" class="btn btn-lg btn-primary">9</button>
			</div>
			<div class="py-2">
				<button onclick="appendPin(6)" class="btn btn-lg btn-primary">6</button>
			</div>
			<div class="py-2">
				<button onclick="appendPin(3)" class="btn btn-lg btn-primary">3</button>
			</div>
			<div class="py-2">
				<button onclick="undoPin()" class="btn btn-lg btn-danger">
					<i class="fas fa-arrow-left"></i>
				</button>
			</div>
		</div>
	</div>
</div>
