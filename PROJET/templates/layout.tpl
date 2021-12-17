<html>
<head>
    <title>{block name=title}Default Page Title{/block}</title>
    {block name=head}
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.3/build/pure-min.css" integrity="sha384-cg6SkqEOCV1NbJoCu11+bm0NvBRc8IYLRGXkmNrqUBfTjmMYwNKPWBTIKyw9mHNJ" crossorigin="anonymous">
    <style>
    #main,footer{ padding:1em }
    </style>
    <link rel="stylesheet" href="templates/style.css">
    {/block}
</head>
<body>
{block name=menu}
<p>Menu de navigation générique défini dans layout.tpl</p>
<a href='./'>index</a>
<a href='register'>inscription</a> 
<a href='login'>connexion</a> 
<a href='candidature'>Candidature</a>
<a href='vuecandidature'>Profil Candidature</a> 
<a href='listecandidature'>Liste des candidatures</a>
{/block}
{block name=body}Contenu générique{/block}
</body>
</html>
