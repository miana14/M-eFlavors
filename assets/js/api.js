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

                // TITRE
                const divInfosRegionCulture = document.createElement('div');
                divInfosRegionCulture.classList.add('div-culture');
                infosRegion.appendChild(divInfosRegionCulture);
                const titreInfosRegionCulture = document.createElement('h2');
                titreInfosRegionCulture.textContent = "Culture";
                divInfosRegionCulture.appendChild(titreInfosRegionCulture);

                //Crée un paragraphe avec les donnée data.culture
                const infoCulture = document.createElement('p');
                infoCulture.textContent = data.culture;
                //Rajoute le paragraphe a la div infosRegion
                divInfosRegionCulture.appendChild(infoCulture);

                // TITRE
                const divInfosRegionHistoire = document.createElement('div');
                divInfosRegionHistoire.classList.add('div-histoire');
                infosRegion.appendChild(divInfosRegionHistoire);
                const titreInfosRegionHistoire = document.createElement('h2');
                titreInfosRegionHistoire.textContent = "Histoire";
                divInfosRegionHistoire.appendChild(titreInfosRegionHistoire);

                //Crée un paragraphe avec les donnée data.story
                const infostory = document.createElement('p');
                infostory.textContent = data.story;
                //Rajoute le paragraphe a la div infosRegion
                divInfosRegionHistoire.appendChild(infostory);

                // TITRE 
                const divInfosRegionFetes = document.createElement('div');
                divInfosRegionFetes.classList.add('div-fetes');
                infosRegion.appendChild(divInfosRegionFetes);
                const titreInfosRegionFetes = document.createElement('h2');
                titreInfosRegionFetes.textContent = "Fêtes Traditionnelles";
                divInfosRegionFetes.appendChild(titreInfosRegionFetes);

                //Crée un paragraphe avec les donnée data.traditionalFestivals
                const infoTraditionalFestivals = document.createElement('p');
                infoTraditionalFestivals.textContent = data.traditionalFestivals;
                //Rajoute le paragraphe a la div infosRegion
                divInfosRegionFetes.appendChild(infoTraditionalFestivals);

                let contenuCulture = document.getElementById('block-infos');
                contenuCulture.appendChild(infosRegion);

            } else {
                // Gérer les erreurs si les données ne sont pas complètes
                console.error('La récupération a échouée');
            }
        })
        .catch(error => {
            // Gérer les erreurs si la requête a échoué
            console.error('Erreur lors de la récupération des données :', error);
        });
    }else {
        if(infosRegionDiv.style.display == "none"){
            infosRegionDiv.style.display = "block";
        }else {
            infosRegionDiv.style.display = "none";
        }
    }
}