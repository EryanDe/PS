document.addEventListener('DOMContentLoaded', function() {
    let currentIndex = 0;
    const images = document.querySelectorAll('#carousel img');
    const maxIndex = images.length;
    images[currentIndex].classList.add('active');

    function changeImage() {
        images[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % maxIndex;
        images[currentIndex].classList.add('active');
    }

    // Change l'image toutes les 3 secondes
    setInterval(changeImage, 4500);

    // Change l'image au clic
    document.getElementById('carousel').addEventListener('click', changeImage);
});


document.addEventListener('DOMContentLoaded', function() {
    let currentIndex = 0;
    const images = document.querySelectorAll('#carousel2 img');
    const maxIndex = images.length;
    images[currentIndex].classList.add('active');

    function changeImage() {
        images[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % maxIndex;
        images[currentIndex].classList.add('active');
    }

    // Change l'image toutes les 3 secondes
    setInterval(changeImage, 4500);

    // Change l'image au clic
    document.getElementById('carousel2').addEventListener('click', changeImage);
});

//modal travail ********************************
// Fonction pour fermer le modal
function closeModal() {
    document.getElementById('protocolModal').style.display = 'none';
}
document.addEventListener('DOMContentLoaded', (event) => {
    // Fonction pour ouvrir le modal
    function openModal() {
        document.getElementById('protocolModal').style.display = 'block';
    }
    // Attacher l'ouverture du modal au bouton
    var openModalButton = document.getElementById('openModalButton');
    if (openModalButton) {
        openModalButton.addEventListener('click', function(e) {
            e.preventDefault(); // Empêche le comportement par défaut du lien
            openModal();
        });
    }
    // Attacher la fermeture du modal à un bouton ou un élément dans le modal
    var closeModalButton = document.getElementById('closeModalButton');
    if (closeModalButton) {
        closeModalButton.addEventListener('click', closeModal);
    }
    // Attacher la validation du choix à un bouton
    var validateChoiceButton = document.getElementById('validateChoice');
    if (validateChoiceButton) {
        validateChoiceButton.addEventListener('click', function() {
            var selectedOption = document.getElementById('protocolSelect').value;
            if (selectedOption) {
                // Redirection vers la page protocole travail
                window.location.href = '/protocoles/5';
            }
        });
    }
});
// Pour fermer le modal en cliquant en dehors de celui-ci 
window.addEventListener('click', function(event) {
    var modal = document.getElementById('protocolModal');
    if (event.target === modal) {
        closeModal();
    }
});

// Fonction pour vérifier si un choix a été fait dans la liste déroulante
function checkSelection() {
    var select = document.getElementById('protocolSelect');
    var button = document.getElementById('validateChoice');
    // Active le bouton si un choix autre que la valeur par défaut est sélectionné
    if (select.value !== "") {
    button.disabled = false;
    } else {
    button.disabled = true;
    }
}

  // Fonction pour fermer le modal
function closeModal() {
    document.getElementById('protocolModal').style.display = 'none';
}


//accordean exercices
document.addEventListener('DOMContentLoaded', function() {
    var accordeons = document.querySelectorAll('.accordeon .header');

    accordeons.forEach(function(header) {
        header.addEventListener('click', function() {
            var content = this.nextElementSibling;

            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    });
});


//Facile difficile exercice switcher
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.difficulty-switch').forEach(switchElement => {
        switchElement.addEventListener('change', function () {
            const exerciceId = this.getAttribute('data-exercice');
            const facileDiv = document.getElementById(`facile_${exerciceId}`);
            const difficileDiv = document.getElementById(`difficile_${exerciceId}`);
            if (this.checked) {
                facileDiv.style.display = "none";
                difficileDiv.style.display = "block";
            } else {
                facileDiv.style.display = "block";
                difficileDiv.style.display = "none";
            }
        });
    });
});




document.addEventListener('DOMContentLoaded', function () {
    const menuIcon = document.querySelector('.menu-icon');
    const nav = document.querySelector('nav ul');

    menuIcon.addEventListener('click', function () {
        if (nav.style.display === 'block') {
            nav.style.display = 'none';
        } else {
            nav.style.display = 'block';
        }
    });
});






  
   