describe('Error Check', () => {
    it('Should not have any console errors', () => {
      cy.visit('http://localhost/capstone2') // Replace '/' with the URL of your web application
      
      // Check if there are any console errors
      cy.window().then((win) => {
        cy.spy(win.console, 'error').as('consoleError')
      })
      cy.get('@consoleError').should('not.be.called')
    })
  })
  