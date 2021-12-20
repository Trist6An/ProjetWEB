{extends file='layout.tpl'}
{block name=title}Register{/block}
{block name=body}
<main class="flex big">
      <section class="flex">
        <article class="flex">
            <h1>Candidature</h1>
            <form action="candidature" method="POST" enctype="multipart/form-data">
                <a>Nom du groupe:</a><br>
                <input type="name" name="name" required="required" value='{$data.name|escape|default:''}'><br>
                {$messages['name']|default:''}<br>

                <a>Département d'origine:</a><br>
                <SELECT name="departement" size="1" value='{$data.departement|escape|default:''}'> <br>
                <OPTION>
                <OPTION>{$tabdep[1]|escape|default:''}
                <OPTION>{$tabdep[2]|escape|default:''}
                <OPTION>{$tabdep[3]|escape|default:''}
                <OPTION>{$tabdep[4]|escape|default:''}
                <OPTION>{$tabdep[5]|escape|default:''}
                </SELECT> {$messages['departement']|default:''}<br>

                <a>type de scene:</a><br>
                <SELECT name="scene" size="1" value='{$data.scene|escape|default:''}'> <br>
                    <OPTION>
                    <OPTION>{$tabscene[1]|escape|default:''}
                    <OPTION>{$tabscene[2]|escape|default:''}
                    <OPTION>{$tabscene[3]|escape|default:''}
                </SELECT> {$messages['scene']|default:''}<br>
                
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
                <input type="text" name="textexperience" required="required" maxlenght=499 value='{$data.textexperience|escape|default:''}'><br>
                {$messages['textexperience']|default:''}<br>

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
                <SELECT name="status" size="1" value='{$data.status|escape|default:''}'> <br>
                    <OPTION>
                    <OPTION>OUI
                    <OPTION>NON
                </SELECT> {$message['scene']|default:''}<br>
                {$messages['status']|default:''}<br>

                <a>Inscrit a la SACEM:</a><br>
                <SELECT name="sacem" size="1" value='{$data.sacem|escape|default:''}'> <br>
                    <OPTION>
                    <OPTION>OUI
                    <OPTION>NON
                </SELECT> {$messages['sacem']|default:''}<br>

                <a>Producteur:</a><br>
                 <SELECT name="producteur" size="1" value='{$data.producteur|escape|default:''}'> <br>
                    <OPTION>
                    <OPTION>OUI
                    <OPTION>NON
                </SELECT> {$messages['producteur']|default:''}<br>

                <a>3 Fichiers MP3:</a><br>
                <input type="file" name="fmp3" multiple accept=".mp3" value='{$files[fmp3]|escape|default:''}'><br>
                <input type="file" name="smp3" multiple accept=".mp3" value='{$files[smp3]|escape|default:''}'><br>
                <input type="file" name="tmp3" multiple accept=".mp3" value='{$files[tmp3]|escape|default:''}'><br>
                {$messages['mp3']|default:''}<br>

                <a>Dossier de presse: ( facultatif )</a><br>
                <input type="file" name="presse" accept=".pdf" value='{$files[presse]|escape|default:''}'><br>
                {$messages['presse']|default:''}<br>

                <a>2 Photos de groupe:</a><br>
                <input type="file" name="fphoto" multiple accept=".jpg, .jpeg, .png" value='{$files[fphoto]|escape|default:''}'><br>
                <input type="file" name="sphoto" multiple accept=".jpg, .jpeg, .png" value='{$files[sphoto]|escape|default:''}'><br>
                {$messages['photo']|default:''}<br>

                <a>Fiche technique format PDF:</a><br>
                <input type="file" name="fiche" accept=".pdf" value='{$files[fiche]|escape|default:''}'><br>
                {$messages['fiche']|default:''}<br>

                <a>Document SACEM format PDF:</a><br>
                <input type="file" name="docsacem" multiple accept=".pdf" value='{$files[docsacem]|escape|default:''}'><br>
                {$messages['docsacem']|default:''}<br>

                <input type="submit" name="" value="Inscription">
            </form>
        </article>
    </section>
</main>
{/block}
