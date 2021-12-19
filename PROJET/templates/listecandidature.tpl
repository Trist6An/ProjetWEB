{extends file='layout.tpl'}
{block name=title}ListeCandidature{/block}
{block name=body}
<h1>Liste des Candidatures:</h1>
<div id='main'>

<table>
   <tr>
       <th> Nom Groupe  </th>
       <th> Page groupe  </th>
       <th> Année de création  </th>
       <th> département origine  </th>
       <th> Présentation    </th>
       <th> Style musical   </th>
       <th> Soundcloud    </th>
       <th> Scène groupe    </th>
       <th> Expériences scéniques   </th>
       <th> Scene Groupe   </th>
       <th> Youtube  </th>
   </tr>
 {foreach from=$donnees item=$Groupe} 
  
    <tr>
       <td> <a href=''>{$Groupe[1]|default:''} </a> </td>
       <td> {$Groupe[2]|default:''} </td>
       <td> {$Groupe[3]|default:''} </td>
       <td> {$Groupe[4]|default:''} </td>
       <td> {$Groupe[5]|default:''} </td>
       <td> {$Groupe[6]|default:''} </td>
       <td> {$Groupe[7]|default:''} </td>
       <td> {$Groupe[8]|default:''} </td>
       <td> {$Groupe[9]|default:''} </td>
       <td> {$Groupe[10]|default:''} </td>
       <td> {$Groupe[11]|default:''} </td>
       <td> {$Groupe[11]|default:'Pas de chaîne Youtube'} </td>
   </tr>

{/foreach}

</table>


</div>
{/block}
