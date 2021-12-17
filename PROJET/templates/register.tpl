{extends file='layout.tpl'}
{block name=title}Register{/block}
{block name=body}
<main class="flex">
     <section class="flex">
          <article class="flex">
          <h1>Register</h1>
               <form class="flex" action="register" method="post">
                    <label for="name">Nom :</label>
                    <input type="text" id="name" name="nom" value="">
                    <p class="error">{$messages['nom']|default:''}</p>

                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="Prenom_utilisateur" value="">
                    <p class="error">{$messages['prenom']|default:''}</p>

                    <label for="mail">E-mail :</label>
                    <input type="email" id="mail" name="courriel" value="">
                    <p class="error">{$messages['email']|default:''}</p>

                    <label for="Password">Mot de Passe :</label>
                    <input type="password" id="motdepasse" name="motdepasse" value="">
                    <p class="error">{$messages['motdepasse']|default:''}</p>

                    <label for="Code_postal">Code_postal :</label>
                    <input type="Code_postal" id="Code_postal" name="Code_postal"  value='{$data.Code_postal|escape|default:''}'>
                    <p class="error">{$messages['code_postal']|default:''}</p>
                    
                    <label for="Adresse_utilisateur">Adresse_utilisateur :</label>
                    <input type="Adresse_utilisateur" id="Adresse_utilisateur" name="Adresse_utilisateur" value='{$data.Adresse_utilisateur|escape|default:''}'>
                    <p class="error">{$messages['adresse_user']|default:''}</p>

                    <input type="submit" value="S'inscrire">
               </form>
          </article>
     </section>
</main>
{/block}