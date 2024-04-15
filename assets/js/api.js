function afficherDonnees() {
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
            if (data.culture && data.story && data.traditionalFestivals) {
                // Afficher les informations sur l'équipe avec une classe pour contrôler la visibilité
                const infosRegion = document.createElement('div');
                infosRegion.classList.add('infos-region');
                infosRegion.id = 'data-';
                infosRegion.style.display = 'block';

                const infoParagraph = document.createElement('p');
                infoParagraph.textContent = data.professionalTitle;
                teamMemberDiv.appendChild(infoParagraph);
                const linkedInLink = document.createElement('a');
                linkedInLink.href = data.linkedinUrl;
                linkedInLink.textContent = 'Profil LinkedIn';
                teamMemberDiv.appendChild(linkedInLink);
                const experiencesList = document.createElement('ul');
                const experiencesTitle = document.createElement('p');
                experiencesTitle.textContent = 'Expériences professionnelles :';
                experiencesList.appendChild(experiencesTitle);

                data.experiences.forEach(experience => {
                    const experienceItem = document.createElement('li');
                    experienceItem.textContent = $ {
                        experience.role
                    }
                    chez $ {
                        experience.company
                    }($ {
                        experience.duration
                    });
                    experiencesList.appendChild(experienceItem);
                });

                teamMemberDiv.appendChild(experiencesList);

                let blockProfil = document.getElementById('block-' + $idProfil);
                // Ajouter le div au document
                blockProfil.appendChild(teamMemberDiv);

            } else {
                // Gérer les erreurs si les données ne sont pas complètes
                console.error('Les données du profil sont incomplètes.');
            }
        })
        .catch(error => {
            // Gérer les erreurs si la requête a échoué
            console.error('Erreur lors de la récupération des données :', error);
        });
}