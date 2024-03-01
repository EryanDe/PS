/// <reference types="cypress" />

Cypress.on('uncaught:exception', (err, runnable) => {
    // Ignorer les erreurs spécifiques liées à `classList` et potentiellement à Stripe
    if (err.message.includes('reading \'classList\'') || err.message.includes('Stripe')) {
        return false; // Ignorer l'erreur
    }
    // Laisser les autres erreurs passer et potentiellement faire échouer le test
});


describe('Test d\'inscription', () => {
    it('Visiter la page d\'inscription et s\'inscrit avec succès', () => {
      // Remplacer 'your_registration_page' par l'URL de votre page d'inscription
    cy.visit('https://localhost:8000/register');
      // Vérifier que la page d'inscription est chargée en cherchant un élément unique à cette page
    cy.contains('h1', 'Bienvenue, veuillez remplir ces champs afin de vous inscrire').should('be.visible');
      // Remplissage du formulaire d'inscription
    cy.get('[name="registration_form[email]"]').type('test@example.com');
    cy.get('[name="registration_form[plainPassword]"]').type('password123');
    cy.get('[name="registration_form[nom_utilisateur]"]').type('Nom');
    cy.get('[name="registration_form[prenom_utilisateur]"]').type('Prénom');
    cy.get('[name="registration_form[telephone_utilisateur]"]').type('0123456789');
    cy.get('[name="registration_form[numero_rue_utilisateur]"]').type('123');
    cy.get('[name="registration_form[rue_utilisateur]"]').type('Rue de Test');
    cy.get('[name="registration_form[ville_utilisateur]"]').type('Ville');
    cy.get('[name="registration_form[code_postal_utilisateur]"]').type('12345');
    //cy.get('[name="registration_form[pays_utilisateur]"]').select('France');
    cy.get('[name="registration_form[agreeTerms]"]').check();
    cy.get('[name="registration_form[relation]"]').type('Relation');
      // Soumission du formulaire d'inscription
    cy.get('form').submit();
      // Vérification de la redirection vers la page de succès
    cy.url().should('include', '/success'); 
      // Redirection vers la page de login pour vérifier si l'utilisateur est connecté
    cy.visit('https://localhost:8000/login');   
    // Vérification de la présence de la phrase indiquant que l'utilisateur est connecté
    cy.contains('Vous êtes connecté en tant que').should('be.visible');
    });
});
  