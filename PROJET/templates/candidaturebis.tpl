{extends file='layout.tpl'}
{block name=title}Candidature bis{/block}
{block name=body}
<h1>Candidature bis</h1>
<div id='main'>
        {for $foo=1 to $to max=$nbmembre} 
            <form action="candidaturebis" method="post">
                <a>Nom</a><br>
                <input type="firstname" name="firstname" required="required" value='{$data.firstname|escape|default:''}'><br>
                {$message['firstname']|default:''}<br>

                <a>Prenom</a><br>
                <input type="name" name="name" required="required" value='{$data.name|escape|default:''}'><br>
                {$message['name']|default:''}<br>

                <a>Adresse</a><br>
                <input type="road" name="adresse" required="required" value='{$data.adresse|escape|default:''}'><br>
                {$message['adresse']|default:''}<br>

                <a>Code Postal</a><br>
                <input type="number" name="codepostal" required="required" value='{$data.codepostal|escape|default:''}'><br>
                {$message['codepostal']|default:''}<br>

                <a>Adresse mail</a><br>
                <input type="email" name="courriel" required="required" value='{$data.courriel|escape|default:''}'><br>
                {$message['courriel']|default:''}<br>

                <a>Telephone</a><br>
                <input type="tel" name="telephone" required="required" value='{$data.telephone|escape|default:''}'><br>
                {$message['telephone']|default:''}<br>
                
                
            </form>
         {/for}
            <input type="submit" name="" value="Inscription">
</div>
{/block}