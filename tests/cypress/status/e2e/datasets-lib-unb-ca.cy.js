const host = 'https://datasets.lib.unb.ca'
describe('Datasets', {baseUrl: host, groups: ['sites']}, () => {

  context('Anniversary search', {baseUrl: `${host}/anniversaries/2017/x5`}, () => {
    beforeEach(() => {
      cy.visit('/')
    })

    specify('Search for "engineering" should find 2+ results', () => {
      cy.get('#views-exposed-form-dsets-browse-anniversaries-page-1')
        .within(() => {
          cy.get('#edit-combine')
            .type('engineering')
        }).submit()
      cy.get('div.view-content > h3:nth-child(1)')
        .should('be.visible')
      cy.get('div.view-content .views-row')
        .should('have.lengthOf.at.least', 2)
    });
  })

})
