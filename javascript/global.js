/*
 * Fonction permettant d'activer / désactiver un input
 * Cela permet de pouvoir le modifier ET une fois désactivé
 * ne plus l'e"nvoyer dans le formulaire
 */
function activeDesactiveInput(inputId) {
	if (document.getElementById(inputId).disabled == true) {
		document.getElementById(inputId).disabled = false;
	} else {
		document.getElementById(inputId).disabled = true;
	}
}

function afficheCacheDiv(idDiv)
{
	if (idDiv == null) {
		return;
	}
	var div = document.getElementById(idDiv);
	if(div != null) {
	    if(div.style.display=="none")
	    {
	    	for (i = 0; i < profil_array.length; i++) { 
	    		document.getElementById(profil_array[i]).style.display="none";
    		}
	        document.getElementById(idDiv).style.display="block";
	    }
	    else
	    {
	        document.getElementById(idDiv).style.display="none";
	    }		
	}
    return true;
}

function ajouteLigneALaFin(idTableau) {
    var cell, ligne,cell2,ligne2;
    var tableau = document.getElementById(idTableau);
    var nbColonnes = tableau.length
    alert("Le tableau "+idTableau+" comporte "+nbColonnes);
    
    // nombre de lignes dans la table (avant ajout de la ligne)
    var nbLignes = (tableau.rows.length / 2);
 
    ligne = tableau.insertRow(-1); // création d'une ligne pour ajout en fin de table
                                   // le paramètre est dans ce cas (-1)
 
    // création et insertion des cellules dans la nouvelle ligne créée
    cell = ligne.insertCell(0);
    cell.innerHTML = '<input type="text" name="escale['+nbLignes+'][ville]"/>';

    ligne = tableau.insertRow(-1); // création d'une ligne pour ajout en fin de table
    // le paramètre est dans ce cas (-1)
 
    // création et insertion des cellules dans la nouvelle ligne créée
    cell2 = ligne.insertCell(0);
    cell2.innerHTML = '<input type="text" name="escale['+nbLignes+'][duree]"/>';
}