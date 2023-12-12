/// <reference types="Cypress" />
//Caching the BO and FO session
const login = (MollieBOFOLoggingIn) => {
  cy.session(MollieBOFOLoggingIn,() => {
  cy.visit('/admin1/')
  cy.url().should('contain', 'https').as('Check if HTTPS exists')
  cy.get('#email').type('demo@prestashop.com',{delay: 0, log: false})
  cy.get('#passwd').type('prestashop_demo',{delay: 0, log: false})
  cy.get('#submit_login').click().wait(1000).as('Connection successsful')
  cy.visit('/en/my-account')
  cy.get('#login-form [name="email"]').eq(0).type('demo@prestashop.com')
  cy.get('#login-form [name="password"]').eq(0).type('prestashop_demo')
  cy.get('#login-form [type="submit"]').eq(0).click({force:true})
  cy.get('#history-link > .link-item').click()
  })
  }

describe('PS8 Visual Regression tests suite', {
  retries: {
    runMode: 0,
    openMode: 0,
  },
},() => {

it.only('PS8 - Testing the visual regression of General Settings page', () => {
  login('MollieBOFOLoggingIn')
  cy.visit('/admin1/')
  cy.get('.mi-mollie').click({fore:true})
  cy.get('#subtab-AdminMollieModule').click()
  cy.matchImage();
});
it('PS8 - Testing the visual regression of Advanced Settings page', () => {
  cy.visit('/admin1/')
  cy.get('.mi-mollie').click({fore:true})
  cy.get('#subtab-AdminMollieModule').click()
  cy.matchImage();
});
it('PS8 - Testing the visual regression of Payments in the Checkout', () => {
  cy.visit('/admin1/')
  cy.get('.mi-mollie').click({fore:true})
  cy.get('#subtab-AdminMollieModule').click()
  cy.matchImage();
});

})
