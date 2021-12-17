{extends file='layout.tpl'}
{block name=title}Login{/block}
{block name=body}
<main class="flex">
	<section class="flex">
		<article class="flex">
		<h1>Login</h1>
			<form class="flex" action="login" method="post">
				<label for="mail">E-mail :</label>
				<input type="email" id="mail" name="courriel" value='{$data.courriel|escape|default:''}'>
				<p class="error">{$messages['email']|default:''}</p>
				<label for="Password">Mot de Passe :</label>
				<input type="password" id="motdepasse" name="motdepasse" value='{$data.motdepasse|escape|default:''}'>
				<p class="error">{$messages['email']|default:''}</p>
				<input type="submit" value="Se connecter">
			</form>
		</article>
	</section>
</main>
{/block}