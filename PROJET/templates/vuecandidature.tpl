{extends file='layout.tpl'}
{block name=title}Profil Candidature{/block}
{block name=body}

<main class="flex"> 

<h1>Ma Candidature:</h1>

Nom:  {$SESSION['Nom_utilisateur']|default:''} <br>

Prénom: {$SESSION['Prenom_utilisateur']|default:''} <br>

Adresse E-mail : {$SESSION['courriel']|default:''} <br>

Adresse Postal: {$SESSION['Adresse_utilisateur']|default:''} <br>

Code Postal: {$SESSION['Code_postal']|default:''}

</main>
{/block}
