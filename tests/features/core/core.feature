# Basic functionality testing.
# Ref : phase2/behat-suite
# http://behat-drupal-extension.readthedocs.io/en/3.1/drupalapi.htm

@api
Feature: Core
  In order to know the website is running
  As a website user
  I need to be able to view the site title and login

  @api
    Scenario: Run cron
      Given I am logged in as a user with the "administrator" role
      When I run cron
      And am on "admin/reports/dblog"
      Then I should see the link "Cron run completed"

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
      When I visit "biographies"
      Then I should see "Title"

    Scenario: Attempt to add an anniversary while not logged in
      Given I am not logged in
      When I am on "node/add/dsets_anniversary_event"
      Then I should see "You are not authorized to access this page"

    Scenario: Attempt to add a biography while not logged in
      Given I am not logged in
      When I am on "node/add/dsets_biography"
      Then I should see "You are not authorized to access this page"

    Scenario: Add an anniversary while logged in
      Given I am logged in as a user with the "dsets_contributor" role
      When I am on "node/add/dsets_anniversary_event"
      Then I should see "Create"

    Scenario: Add an biography while logged in
      Given I am logged in as a user with the "dsets_contributor" role
      When I am on "node/add/dsets_biography"
      Then I should see "Create"

    Scenario: Create a term
      Given I am logged in as a user with the "administrator" role
      When I am viewing a "tags" term with the name "My tag"
      Then I should see the heading "My tag"
