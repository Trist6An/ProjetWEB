{extends file='layout.tpl'}
{block name=title}Register{/block}
{block name=body}
<h1>Candidature</h1>
<div id='main'>
    <form action="candidature" method="post">
        <a>Nom du groupe</a><br>
        <input type="name" name="name" required="required" value='{$data.name|escape|default:''}'><br>
        {$message['name']|default:''}<br>

        <a>Département d'origine</a><br>
        <input type="number" name="departement" required="required" value='{$data.departement|escape|default:''}'><br>
        {$message['departement']|default:''}<br>

        <a>type de scene</a><br>
        <input type="text" name="scene" required="required" value='{$data.scene|escape|default:''}'><br>
        {$message['scene']|default:''}<br>

        <a>Répresentant du groupe ( a revoir)</a><br>
        <input type="town" name="ville" required="required" value='{$data.ville|escape|default:''}'><br>
        {$message['ville']|default:''}<br>

        <a>Style musical</a><br>
        <input type="country" name="stylemusical" required="required" value='{$data.stylemusical|escape|default:''}'><br>
        {$message['stylemusical']|default:''}<br>

        <a>Année de création</a><br>
        <input type="month" name="creation" required="required" value='{$data.creation|escape|default:''}'><br>
        {$message['creation']|default:''}<br>

        <a>Présentation du texte (inférieur a 500 caractères)</a><br>
        <input type="text" name="textepresentation" required="required" maxlenght=499 value='{$data.textepresentation|escape|default:''}'><br>
        {$message['textepresentation']|default:''}<br>

        <a>Expérience scénique (inférieur a 500 caractères)</a><br>
        <input type="text" name="experience" maxlenght=499 required="required" value='{$data.expericence|escape|default:''}'><br>
        {$message['experience']|default:''}<br>

        <a>Présentation du texte (inférieur a 500 caractères)</a><br>
        <input type="text" name="textepresentation" required="required" maxlenght=499 value='{$data.textepresentation|escape|default:''}'><br>
        {$message['textepresentation']|default:''}<br>

        <a>Site Web ou page Facebook</a><br>
        <input type="url" name="sitefb" required="required" value='{$data.sitefb|escape|default:''}'><br>
        {$message['sitefb']|default:''}<br>

        <a>Soundcloud (Facultatif)</a><br>
        <input type="url" name="soundcloud" value='{$data.soundcloud|escape|default:''}'><br>
        {$message['soundcloud']|default:''}<br>

        <a>Youtube (Facultatif)</a><br>
        <input type="url" name="youtube" value='{$data.youtube|escape|default:''}'><br>
        {$message['youtube']|default:''}<br>

        <a>membre du groupe nombre</a><br>
        <input type="number" name="nbmembre" min="1" max="10" value="1" required="required" value='{$data.nbmembre|escape|default:''}'><br>
        {$message['nbmembre']|default:''}<br>

        <a>Status associatif</a><br>
        <input type="checkbox" id="status" name="status" value='{$data.status|escape|default:''}'>
        <label for="status">Oui</label>
        {$message['status']|default:''}<br>
        <input type="checkbox" id="status" name="status" value='{$data.status|escape|default:''}'>
        <label for="status">Non</label>
        {$message['status']|default:''}<br><br>

        <a>Inscrit a la SACEM</a><br>
        <input type="checkbox" id="sacem" name="sacem" value='{$data.sacem|escape|default:''}'>
        <label for="sacem">Oui</label>
        {$message['sacem']|default:''}<br>
        <input type="checkbox" id="sacem" name="sacem" value='{$data.sacem|escape|default:''}'>
        <label for="sacem">Non</label>
        {$message['sacem']|default:''}<br><br>

        <a>Producteur</a><br>
        <input type="checkbox" id="producteur" name="producteur" value='{$data.producteur|escape|default:''}'>
        <label for="producteur">Oui</label>
        {$message['producteur']|default:''}<br>
        <input type="checkbox" id="producteur" name="producteur" value='{$data.producteur|escape|default:''}'>
        <label for="producteur">Non</label>
        {$message['producteur']|default:''}<br><br>

        <a>3 Fichier MP3</a><br>
        <input type="file" name="music1" accept=".mp3" required="required" value='{$data.music1|escape|default:''}'><br>
        {$message['mp3']|default:''}<br>
        <input type="file" name="music2" accept=".mp3" required="required" value='{$data.music2|escape|default:''}'><br>
        {$message['mp3']|default:''}<br>
        <input type="file" name="music3" accept=".mp3" required="required" value='{$data.music3|escape|default:''}'><br>
        {$message['mp3']|default:''}<br>

        <a>Dossier de presse ( facultatif )</a><br>
        <input type="file" name="presse" accept=".pdf" value='{$data.presse|escape|default:''}'><br>
        {$message['presse']|default:''}<br>

        <a>2 Photos de groupe</a><br>
        <input type="file" name="photo1" accept=".jpg, .jpeg, .png" required="required" value='{$data.photo1|escape|default:''}'><br>
        {$message['photo1']|default:''}<br>
        <input type="file" name="photo2" accept=".jpg, .jpeg, .png" required="required" value='{$data.photo2|escape|default:''}'><br>
        {$message['photo2']|default:''}<br>

        <a>Fiche technique format PDF</a><br>
        <input type="file" name="fiche" accept=".pdf" required="required" value='{$data.fiche|escape|default:''}'><br>
        {$message['fiche']|default:''}<br>

        <a>Document SACEM format PDF</a><br>
        <input type="file" name="docsacem" multiple accept=".pdf" required="required" value='{$data.docsacem|escape|default:''}'><br>
        {$message['docsacem']|default:''}<br>

        <input type="submit" name="" value="Inscription">
    </form>
</div>
{/block}