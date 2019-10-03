@api
Feature: Core
  In order to know the website is running
  As a website user
  I need to be able to view the site title and login

  @api
    Scenario: Create users
      Given users:
      | name     | mail            | status |
      | Joe User | joe@example.com | 1      |
      And I am logged in as a user with the "administrator" role
      When I visit "admin/people"
      Then I should see the link "Joe User"

    Scenario: Login as a user created during this scenario
      Given users:
      | name      | status |
      | Test user |      1 |
      When I am logged in as "Test user"
      Then I should see the link "Log out"

    Scenario: Not logged in
      Given I am not logged in
      Then I should see the link "Log in"

    Scenario: Browsing existing anniversaries while not logged in
      Given I am not logged in
      When I visit "anniversaries"
      Then I should see "Reference Year"

    Scenario: Browsing existing biographies while not logged in
      Given I am not logged in
      When I am on "/"
      Then I should not see "Biographies"

    Scenario: Browsing existing biographies while not logged in
      Given I am logged in as a user with the "dsets_biographies_user" role
      When I am on "/"
      Then I should see "Biographies"

    Scenario: Browsing existing biographies while not logged in
      Given I am logged in as a user with the "dsets_anniversaries_contributor" role
      When I am on "/"
      Then I should not see "Biographies"

    Scenario: Attempt to add an anniversary while not logged in
      Given I am not logged in
      When I am on "node/add/dsets_anniversary_event"
      Then I should see "You are not authorized to access this page"

    Scenario: Attempt to add a biography while not logged in
      Given I am not logged in
      When I am on "node/add/dsets_biography"
      Then I should see "You are not authorized to access this page"

    Scenario: Add an anniversary while logged in
      Given I am logged in as a user with the "dsets_anniversaries_contributor" role
      When I am on "node/add/dsets_anniversary_event"
      Then I should see "Create"

    Scenario: Add a biography while logged in
      Given I am logged in as a user with the "dsets_biographies_contributor" role
      When I am on "node/add/dsets_biography"
      Then I should see "Create"
