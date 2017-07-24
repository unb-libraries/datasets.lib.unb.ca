<?php

namespace Drupal\dsets_anniversaries\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

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
      '#title' => t('Year:'),
      '#required' => TRUE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
