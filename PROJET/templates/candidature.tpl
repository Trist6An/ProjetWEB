{extends file='layout.tpl'}
{block name=title}Register{/block}
{block name=body}
<main class="flex big">
    <section class="flex">
        <article class="flex">
            <h1>Candidature</h1>
            <form class="flex moy" action="candidature" method="post">
                <label>Nom du groupe:</label>
                <input type="name" name="name" required="required" value='{$data.name|escape|default:''}'>
                {$message['name']|default:''}

                <label>Département d'origine:</label>
                <SELECT name="département" size="1" value='{$data.departement|escape|default:''}'> 
                <OPTION>{$departement.1|escape|default:''}
                <OPTION>{$departement.2|escape|default:''}
                <OPTION>{$departement.3|escape|default:''}
                <OPTION>{$departement.4|escape|default:''}
                <OPTION>{$departement.5|escape|default:''}
                </SELECT> {$message['departement']|default:''}
        
                <label>type de scene</label>
                <SELECT name="scene" size="1" value='{$data.scene|escape|default:''}'> 
                <OPTION>{$scene.1|escape|default:''}
                <OPTION>{$scene.2|escape|default:''}
                <OPTION>{$scene.3|escape|default:''}
                </SELECT> {$message['scene']|default:''}
                
                <label>Répresentant du groupe: ( à revoir)</label>
                <input type="town" name="ville" required="required" value='{$data.ville|escape|default:''}'>
                {$messages['ville']|default:''}

                <label>Style musical:</label>
                <input type="country" name="stylemusical" required="required" value='{$data.stylemusical|escape|default:''}'>
                {$messages['stylemusical']|default:''}

                <label>Année de création:</label>
                <input type="month" name="creation" required="required" value='{$data.creation|escape|default:''}'>
                {$messages['creation']|default:''}

                <label>Présentation du texte: (inférieur à 500 caractères)</label>
                <input type="text" name="textepresentation" required="required" maxlenght=499 value='{$data.textepresentation|escape|default:''}'>
                {$messages['textepresentation']|default:''}

                <label>Expérience scénique: (inférieur à 500 caractères)</label>
                <input type="text" name="experience" maxlenght=499 required="required" value='{$data.expericence|escape|default:''}'>
                {$messages['experience']|default:''}

                <label>Présentation du texte: (inférieur à 500 caractères)</label>
                <input type="text" name="textepresentation" required="required" maxlenght=499 value='{$data.textepresentation|escape|default:''}'>
                
                {$messages['textepresentation']|default:''}

                <label>Site Web ou page Facebook:</label>
                <input type="url" name="sitefb" required="required" value='{$data.sitefb|escape|default:''}'>
                {$messages['sitefb']|default:''}

                <label>Soundcloud: (Facultatif)</label>
                <input type="url" name="soundcloud" value='{$data.soundcloud|escape|default:''}'>
                {$messages['soundcloud']|default:''}

                <label>Youtube: (Facultatif)</label>
                <input type="url" name="youtube" value='{$data.youtube|escape|default:''}'>
                {$messages['youtube']|default:''}

                <label>membre du groupe: nombre</label>
                <input type="number" name="nbmembre" min="1" max="10" value="1" required="required" value='{$data.nbmembre|escape|default:''}'>
                {$messages['nbmembre']|default:''}

                <label>Status associatif:</label>
                <div>
                    <input type="radio" id="statusoui" name="statusoui" value='{$data.statusoui|escape|default:''}'>
                    <label for="statusoui">Oui</label>
                    {$messages['statusoui']|default:''}
                </div>
                <div>
                    <input type="radio" id="statusnon" name="statusnon" value='{$data.statusnon|escape|default:''}'>
                    <label for="statusnon">Non</label>
                    {$messages['statusnon']|default:''}
                </div>

                <label>Inscrit a la SACEM:</label>
                <div>
                    <input type="radio" id="sacemoui" name="sacemoui" value='{$data.sacemoui|escape|default:''}'>
                    <label for="sacemoui">Oui</label>
                    {$messages['sacemoui']|default:''}
                </div>
                <div>
                    <input type="radio" id="sacemnoni" name="sacemnon" value='{$data.sacemnon|escape|default:''}'>
                    <label for="sacemnon">Non</label>
                    {$messages['sacemnon']|default:''}
                </div>
                
                    <label>Producteur:</label>
                
                <div>
                    <input type="radio" id="producteuroui" name="producteuroui" value='{$data.producteuroui|escape|default:''}'>
                    <label for="producteuroui">Oui</label>
                    {$messages['producteuroui']|default:''}
                </div>
                <div>
                    <input type="radio" id="producteurnon" name="producteurnon" value='{$data.producteurnon|escape|default:''}'>
                    <label for="producteurnon">Non</label>
                    {$messages['producteurnon']|default:''}
                </div>

                <label>3 Fichier MP3:</label>
                <input type="file" name="mp3" multiple accept=".mp3" required="required" value='{$data.mp3|escape|default:''}'>
                {$messages['mp3']|default:''}

                <label>Dossier de presse: ( facultatif )</label>
                <input type="file" name="presse" accept=".pdf" value='{$data.presse|escape|default:''}'>
                {$messages['presse']|default:''}

                <label>2 Photos de groupe:</label>
                <input type="file" name="photo" multiple accept=".jpg, .jpeg, .png" required="required" value='{$data.photo|escape|default:''}'>
                {$messages['photo']|default:''}

                <label>Fiche technique format PDF:</label>
                <input type="file" name="fiche" accept=".pdf" required="required" value='{$data.fiche|escape|default:''}'>
                {$messages['fiche']|default:''}

                <label>Document SACEM format PDF:</label>
                <input type="file" name="docsacem" multiple accept=".pdf" required="required" value='{$data.docsacem|escape|default:''}'>
                {$messages['docsacem']|default:''}

                <input type="submit" name="" value="Inscription">
            </form>
        </article>
    </section>
</main>
{/block}