{extends file='layout.tpl'}
{block name=title}Register{/block}
{block name=body}
<main class="flex big">
    <section class="flex">
        <article class="flex">
            <h1>Candidature</h1>
            <form action="candidature" method="post" enctype="multipart/form-data">
                <a>Nom du groupe:</a><br>
                <input type="name" name="name" required="required" value='{$data.name|escape|default:''}'><br>
                {$message['name']|default:''}<br>

                <a>Département d'origine:</a><br>
                <SELECT name="département" size="1" value='{$data.departement|escape|default:''}'> <br>
                <OPTION>{$tabdep[1]|escape|default:''}
                <OPTION>{$tabdep[2]|escape|default:''}
                <OPTION>{$tabdep[3]|escape|default:''}
                <OPTION>{$tabdep[4]|escape|default:''}
                <OPTION>{$tabdep[5]|escape|default:''}
                </SELECT> {$message['departement']|default:''}<br>
                <a>type de scene:</a><br>
                <SELECT name="scene" size="1" value='{$data.scene|escape|default:''}'> <br>
                    <OPTION>{$tabscene[1]|escape|default:''}
                    <OPTION>{$tabscene[2]|escape|default:''}
                    <OPTION>{$tabscene[3]|escape|default:''}
                </SELECT> {$message['scene']|default:''}<br>
                
                <a>Répresentant du groupe: </a><br>
                <input type="representant" name="representant" required="required" value='{$data.representant|escape|default:''}'><br>
                {$messages['representant']|default:''}<br>

                <a>Style musical:</a><br>
                <input type="country" name="stylemusical" required="required" value='{$data.stylemusical|escape|default:''}'><br>
                {$messages['stylemusical']|default:''}<br>

                <a>Année de création:</a><br>
                <input type="month" name="creation" required="required" value='{$data.creation|escape|default:''}'><br>
                {$messages['creation']|default:''}<br>

                <a>Présentation du texte: (inférieur a 500 caractères)</a><br>
                <input type="text" name="textepresentation" required="required" maxlenght=499 value='{$data.textepresentation|escape|default:''}'><br>
                {$messages['textepresentation']|default:''}<br>

                <a>Expérience scénique: (inférieur a 500 caractères)</a><br>
                <input type="text" name="texteexperience" maxlenght=499 required="required" value='{$data.texteexpericence|escape|default:''}'><br>
                {$messages['experience']|default:''}<br>

                <a>Site Web ou page Facebook:</a><br>
                <input type="url" name="sitefb" required="required" value='{$data.sitefb|escape|default:''}'><br>
                {$messages['sitefb']|default:''}<br>

                <a>Soundcloud: (Facultatif)</a><br>
                <input type="url" name="soundcloud" value='{$data.soundcloud|escape|default:''}'><br>
                {$messages['soundcloud']|default:''}<br>

                <a>Youtube: (Facultatif)</a><br>
                <input type="url" name="youtube" value='{$data.youtube|escape|default:''}'><br>
                {$messages['youtube']|default:''}<br>

                <a>membre du groupe: nombre</a><br>
                <input type="number" name="nbmembre" min="1" max="10" value="1" required="required" value='{$data.nbmembre|escape|default:''}'><br>
                {$messages['nbmembre']|default:''}<br>

                <a>Status associatif:</a><br>
                <input type="radio" id="statusoui" name="statusoui" value='{$data.statusoui|escape|default:''}'><br>
                <label for="statusoui">Oui</label>
                <input type="radio" id="statusnon" name="statusnon" value='{$data.statusnon|escape|default:''}'><br>
                <label for="statusnon">Non</label>
                {$messages['status']|default:''}

                <a>Inscrit a la SACEM:</a><br>
                <input type="radio" id="sacemoui" name="sacemoui" value='{$data.sacemoui|escape|default:''}'><br>
                <label for="sacemoui">Oui</label>
                <input type="radio" id="sacemnon" name="sacemnon" value='{$data.sacemnon|escape|default:''}'><br>
                <label for="sacemnon">Non</label>
                {$messages['sacem']|default:''}<br>

                <a>Producteur:</a><br>
                <input type="radio" id="producteuroui" name="producteuroui" value='{$data.producteuroui|escape|default:''}'><br>
                <label for="producteuroui">Oui</label>
                <input type="radio" id="producteurnon" name="producteurnon" value='{$data.producteurnon|escape|default:''}'><br>
                <label for="producteurnon">Non</label>
                {$messages['producteur']|default:''}<br>

                <a>3 Fichier MP3:</a><br>
                <input type="file" name="mp3" multiple accept=".mp3" required="required" value='{$files.fmp3|escape|default:''}'><br>
                <input type="file" name="mp3" multiple accept=".mp3" required="required" value='{$files.smp3|escape|default:''}'><br>
                <input type="file" name="mp3" multiple accept=".mp3" required="required" value='{$files.tmp3|escape|default:''}'><br>
                {$messages['mp3']|default:''}<br>

                <a>Dossier de presse: ( facultatif )</a><br>
                <input type="file" name="presse" accept=".pdf" value='{$files.presse|escape|default:''}'><br>
                {$messages['presse']|default:''}<br>

                <a>2 Photos de groupe:</a><br>
                <input type="file" name="photo" multiple accept=".jpg, .jpeg, .png" required="required" value='{$files.fphoto|escape|default:''}'><br>
                <input type="file" name="photo" multiple accept=".jpg, .jpeg, .png" required="required" value='{$files.sphoto|escape|default:''}'><br>
                {$messages['photo']|default:''}<br>

                <a>Fiche technique format PDF:</a><br>
                <input type="file" name="fiche" accept=".pdf" required="required" value='{$files.fiche|escape|default:''}'><br>
                {$messages['fiche']|default:''}<br>

                <a>Document SACEM format PDF:</a><br>
                <input type="file" name="docsacem" multiple accept=".pdf" required="required" value='{$files.docsacem|escape|default:''}'><br>
                {$messages['docsacem']|default:''}<br>

                <input type="submit" name="" value="Inscription">
            </form>
        </article>
    </section>
</main>
{/block}