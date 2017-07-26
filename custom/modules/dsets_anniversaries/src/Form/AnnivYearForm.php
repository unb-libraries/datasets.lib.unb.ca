<?php

namespace Drupal\dsets_anniversaries\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Controller for Anniversaries reference year form.
 */
class AnnivYearForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'dsets_anniv_year_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['reference_year'] = [
      '#type' => 'textfield',
      '#title' => t('Reference Year'),
      '#required' => FALSE,
    ];

    $form['anniv_x5'] = [
      '#type' => 'checkbox',
      '#title' => t('5-year multiples only'),
    ];

    $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Go'),
      '#button_type' => 'primary',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $year = $form_state->getValue('reference_year');

    if (!is_numeric($year) || (int) $year < 1785) {
      $form_state->setErrorByName('reference_year',
        t('Reference Year must be a possitive number larger than 1785.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $year = (int) $form_state->getValue('reference_year');
    $year = $year == '' ? '2017' : $year;
    $x5_bool = $form_state->getValue('anniv_x5');
    $x5 = $x5_bool ? 'x5' : 'all';
    $response = new RedirectResponse('/anniversaries/' . $year . '/' . $x5);
    $response->send();
  }

}
