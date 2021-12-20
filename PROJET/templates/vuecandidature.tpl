{extends file='layout.tpl'}
{block name=title}Profil Candidature{/block}
{block name=body}

<main class="flex"> 
    <section class="flex">
        <article class="flex">
            <h1>Ma Candidature:</h1>
            Nom:  {$SESSION['Nom_utilisateur']|default:''} <br>
            Prénom: {$SESSION['Prenom_utilisateur']|default:''} <br>
            Adresse E-mail : {$SESSION['courriel']|default:''} <br>
            Adresse Postal: {$SESSION['Adresse_utilisateur']|default:''} <br>
            Code Postal: {$SESSION['Code_postal']|default:''}
        	
        	<h1>{$SESSION['Nom_groupe']}</h1>
        	<img src={$SESSION['Photos'][0]}>
            <img src={$SESSION['Photos'][1]}>
            <audio src={$SESSION['Musiques'][0]}>
            <audio src={$SESSION['Musiques'][1]}>
            <audio src={$SESSION['Musiques'][2]}>
            
        </article>
    </section>
    <section class="flex">
    </section>
</main>
{/block}
