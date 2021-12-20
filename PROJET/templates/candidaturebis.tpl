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

                <a>Instrument</a><br>
                <input type="text" name="Instrument" required="required" value='{$data.Instrument|escape|default:''}'><br>
                {$message['Instrument']|default:''}<br>              
                
            </form>
         {/for}
            <input type="submit" name="" value="Inscription">
</div>
{/block}