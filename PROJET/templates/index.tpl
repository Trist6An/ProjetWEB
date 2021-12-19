{extends file='layout.tpl'}
{block name=title}Accueil{/block}
{block name=body}
<div id='main'>
<h1>Home</h1>

<form action="index" method="post">

{if ($SESSION['Nom']|default:'') eq '' }
Bienvenue!<br>
<a href='register'>Créer un compte </a>
<a href='login'>Se Connecter</a> 
{else}
Bienvenue {$SESSION['Nom']} ! <br>
Voir <a href='vuecandidature'>Mon Profil Candidature</a> |
<a href='logout'>Me déconnecter</a>
{/if}

</form>

</div>
{/block}
