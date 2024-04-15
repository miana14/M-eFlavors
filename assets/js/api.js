function afficherDonnees() {

    const infosRegionDiv = document.getElementById('data-region');

    if(infosRegionDiv == null){
    
    // URL de l'API externe
    let url = "https://mae-flavors-api.onrender.com/";
    fetch(url, {
            mode: 'cors'
        })
        .then(response => {
            // Vérifier si la requête a réussi
            if (!response.ok) {
                throw new Error('La requête a échoué.');
            }
            // Récupérer et retourner les données JSON
            return response.json();
        })
        .then(data => {
            // Vérifier si les données sont bien présentes
            // Vérifier si les données sont bien présente dans l'API
            if (data.culture && data.story && data.traditionalFestivals) {

                //Crée une div avec une classe et un ID
                const infosRegion = document.createElement('div');
                //Rajoute la classe infos-region a la div
                infosRegion.classList.add('infos-region');
                infosRegion.style.display = "block";
                //Rajoute l'ID data-region a la div
                infosRegion.id = 'data-region';

                //Crée un paragraphe avec les donnée data.culture
                const titreInfosRegion = document.createElement('h2');
                titreInfosRegion.textContent = "Culture";
                //Rajoute le paragraphe a la div infosRegion
                infosRegion.appendChild(titreInfosRegion);

                //Crée un paragraphe avec les donnée data.culture
                const infoCulture = document.createElement('p');
                infoCulture.textContent = data.culture;
                //Rajoute le paragraphe a la div infosRegion
                infosRegion.appendChild(infoCulture);

                //Crée un paragraphe avec les donnée data.story
                const infostory = document.createElement('p');
                infostory.textContent = data.story;
                //Rajoute le paragraphe a la div infosRegion
                infosRegion.appendChild(infostory);

                //Crée un paragraphe avec les donnée data.traditionalFestivals
                const infotraditionalFestivals = document.createElement('p');
                infotraditionalFestivals.textContent = data.culture;
                //Rajoute le paragraphe a la div infosRegion
                infosRegion.appendChild(infotraditionalFestivals);

                let contenuCulture = document.getElementById('block-culture');
                contenuCulture.appendChild(infosRegion);

            } else {
                // Gérer les erreurs si les données ne sont pas complètes
                console.error('Les données du profil sont incomplètes.');
            }
        })
        .catch(error => {
            // Gérer les erreurs si la requête a échoué
            console.error('Erreur lors de la récupération des données :', error);
        });
    }else {
        if(infosRegionDiv.style.display == "block"){
            infosRegionDiv.style.display = "none";
        }else {
            infosRegionDiv.style.display = "block";
        }
    }
}