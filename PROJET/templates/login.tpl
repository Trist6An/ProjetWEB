{extends file='layout.tpl'}
{block name=title}Login{/block}
{block name=body}
<main class="flex">
<h1>Login</h1>
<form action="login" method="post">
  <div>
        <label for="mail">E-mail :</label> <br>
        <input type="email" id="mail" name="courriel" value='{$data.courriel|escape|default:''}'>
         {$messages['email']|default:''}
   </div>
   <div>
        <label for="Password">Mot de Passe :</label> <br>
        <input type="password" id="motdepasse" name="motdepasse" value='{$data.motdepasse|escape|default:''}'>
        {$messages['motdepasse']|default:''}
   </div>
  </div>  
 <input type="submit" value="Connexion">
</form>
</main>
{/block}
