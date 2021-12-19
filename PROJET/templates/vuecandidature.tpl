{extends file='layout.tpl'}
{block name=title}VueCandidature{/block}
{block name=body}

<div id='main'>

<h1>Ma Candidature:</h1>

Nom:  {$SESSION['Nom_utilisateur']|default:''} <br>

Prénom: {$SESSION['Prenom_utilisateur']|default:''} <br>

Adresse E-mail : {$SESSION['courriel']|default:''} <br>

Adresse Postal: {$SESSION['Adresse_utilisateur']|default:''} <br>

Code Postal: {$SESSION['Code_postal']|default:''}

</div>
{/block}