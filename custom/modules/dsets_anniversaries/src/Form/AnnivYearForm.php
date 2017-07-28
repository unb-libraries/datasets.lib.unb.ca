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
      '#default_value' => \Drupal::state()->get('dsets_state_year'),
      '#required' => FALSE,
    ];

    $form['anniv_x5'] = [
      '#type' => 'checkbox',
      '#title' => t('Display anniversaries in 5-year increments'),
      '#default_value' => \Drupal::state()->get('dsets_state_x5'),
      '#required' => FALSE,
    ];

    $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Apply'),
      '#button_type' => 'primary',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $year = $form_state->getValue('reference_year');

    if ($year != '' and !is_numeric($year) || (int) $year < 1785) {
      $form_state->setErrorByName('reference_year',
        t('Reference Year must be a possitive number larger than 1785.'));
    }

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $year = $form_state->getValue('reference_year');
    $year = $year ? $year : date('Y');

    $x5_bool = $form_state->getValue('anniv_x5');
    $x5 = $x5_bool ? 'x5' : 'all';

    \Drupal::state()->set('dsets_state_year', $year);
    \Drupal::state()->set('dsets_state_x5', $x5_bool);

    $args = \Drupal::request()->query->all();
    $subject = $args['field_dsets_anniv_event_subject_target_id'];
    $title = $args['title'];
    $qstring = '?' . 'field_dsets_anniv_event_subject_target_id=' . $subject .
      '&title=' . $title;

    $response = new RedirectResponse('/anniversaries/' . $year . '/' . $x5 .
      $qstring);
    $response->send();
  }

}
