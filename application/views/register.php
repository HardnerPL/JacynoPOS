<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/15/2019
 * Time: 7:58 PM
 */
?>

<div class="container center-content">
	<form action="" method="post">
		<div class="form-group">
			<label for="username">Nazwa użytkownika</label>
			<input type="text" class="form-control" name="username" placeholder="Nazwa użytkownika">
		</div>
		<div class="form-group">
			<label for="password">Hasło</label>
			<input type="password" class="form-control" name="password" placeholder="Hasło">
		</div>
		<div class="form-group">
			<label for="repeat_password">Powtórz hasło</label>
			<input type="password" class="form-control" name="repeat_password" placeholder="Powtórz hasło">
		</div>
		<div class="text-center">
			<button type="submit" class="btn btn-primary">Zarejestruj się</button>
		</div>
		<div class="my-2">
			Masz już konto? <a href="login">Zaloguj się!</a>
		</div>
	</form>
</div>
