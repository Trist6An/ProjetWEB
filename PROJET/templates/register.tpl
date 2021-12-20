{extends file='layout.tpl'}
{block name=title}Register{/block}
{block name=body}
<h1>Register</h1>
<main class="flex"> 
<form action="register" method="post">
   <div>
        <label for="name">Nom :</label> <br>
        <input type="text" id="name" name="Nom_Utilisateur" value='{$data.Nom_Utilisateur|escape|default:''}'>
          {$messages['nom']|default:''}
   </div>
    <div>
        <label for="prenom">Prénom :</label> <br>
        <input type="text" id="prenom" name="Prenom_utilisateur" value='{$data.Prenom_utilisateur|escape|default:''}'>
          {$messages['prenom']|default:''}
   </div>
   <div>
        <label for="mail">E-mail :</label> <br>
        <input type="email" id="mail" name="courriel"  value='{$data.courriel|escape|default:''}'>
          {$messages['email']|default:''}
   </div>
   <div>
        <label for="Password">Mot de Passe :</label> <br>
        <input type="password" id="motdepasse" name="motdepasse" value='{$data.motdepasse|escape|default:''}'>  
       {$messages['motdepasse']|default:''}
   </div>
   <div>
        <label for="Code_postal">Code_postal :</label> <br>
        <input type="Code_postal" id="Code_postal" name="Code_postal"  value='{$data.Code_postal|escape|default:''}'>
          {$messages['code_postal']|default:''}
   </div>
   <div>
        <label for="Adresse_utilisateur">Adresse_utilisateur :</label> <br>
        <input type="Adresse_utilisateur" id="Adresse_utilisateur" name="Adresse_utilisateur" 
        value='{$data.Adresse_utilisateur|escape|default:''}'>
          {$messages['adresse_user']|default:''} 
   </div>
   <input type="submit" value="S'inscrire">
   </form>
</main> 
{/block}
