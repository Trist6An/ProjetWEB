{extends file='layout.tpl'}
{block name=title}Accueil{/block}
{block name=body}
<main class="flex">
    <section class="flex">
        <article class="flex">     
            {if ($SESSION['Nom']|default:'') eq '' }
            <h1>Bienvenue!</h1>
            <div class="links flex"><a href='register'>Créer un compte </a>|<a href='login'>Se Connecter</a></div>
            {else}
            <h1>Bienvenue {$SESSION['Nom']} !</h1>
            <div class="links flex"><a href='profil'>Voir Mon Profil</a>|<a href='logout'>Me déconnecter</a></div>
            {/if}
        </article>
    </section>
</main>
{/block}