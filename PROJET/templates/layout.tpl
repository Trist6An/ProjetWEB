<html>
<head>
    <title>{block name=title}Default Page Title{/block}</title>
    {block name=head}
    <style>
    #main,footer{ padding:1em }
    </style>
    <link rel="stylesheet" href="templates/style.css">
    {/block}
</head>
<body>
{block name=menu}
<header class="flex">
    <div class="flex">
        <a href='./'>index</a>
        <a href='register'>inscription</a> 
        <a href='login'>connexion</a> 
        <a href='candidature'>Candidature</a>
        <a href='vuecandidature'>Profil Candidature</a> 
        <a href='listecandidature'>Liste des candidatures</a>
    </div>
</header>
{/block}
{block name=body}Contenu générique{/block}
</body>
</html>