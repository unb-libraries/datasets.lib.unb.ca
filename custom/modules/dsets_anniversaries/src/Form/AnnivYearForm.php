<?php

namespace Drupal\dsets_anniversaries\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Path\CurrentPathStack;
use Drupal\Core\State\State;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Controller for Anniversaries reference year form.
 */
class AnnivYearForm extends FormBase {
  /**
   * For services dependency injection.
   *
   * @var Drupal\Core\Path\CurrentPathStack
   */
  protected $pathCurrent;

  /**
   * For services dependency injection.
   *
   * @var Drupal\Core\State\State
   */
  protected $state;

  /**
   * For services dependency injection.
   *
   * @var Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;

  /**
   * Class constructor.
   *
   * @param \Drupal\Core\Path\CurrentPathStack $path_current
   *   The current path service.
   * @param \Drupal\Core\State\State $state
   *   The Drupal state service.
   * @param \Symfony\Component\HttpFoundation\RequestStack $request_stack
   *   The Symfony request stack service.
   */
  public function __construct(
    CurrentPathStack $path_current,
    State $state,
    RequestStack $request_stack) {
    $this->pathCurrent = $path_current;
    $this->state = $state;
    $this->requestStack = $request_stack;
  }

  /**
   * Object create method.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   Container interface.
   *
   * @return static
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('path.current'),
      $container->get('state'),
      $container->get('request_stack')
    );
  }

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

    $path = $this->pathCurrent->getPath();

    preg_match_all('!\d+!', $path, $matches);
    $year = $matches[0][0];

    $x5 = strpos($path, 'x5') ? TRUE : FALSE;

    $form['reference_year'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Reference Year'),
      '#default_value' => $year,
      '#required' => FALSE,
    ];

    $form['anniv_x5'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('5-year increments'),
      '#default_value' => $x5,
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
        $this->t('Reference Year must be a possitive number larger than 1785.'));
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

    $this->state->set('dsets_state_year', $year);
    $this->state->set('dsets_state_x5', $x5_bool);

    $args = $this->requestStack->getCurrentRequest()->query->all();

    $subject = isset($args['field_dsets_anniv_event_subject_target_id']) ?
      'field_dsets_anniv_event_subject_target_id=' .
      $args['field_dsets_anniv_event_subject_target_id'] : NULL;

    $search = isset($args['combine']) ? '&combine=' . $args['combine'] : '';

    $qstring = '?' . $subject . $search;
    $response = new RedirectResponse('/anniversaries/' . $year . '/' . $x5 .
      $qstring);

    $response->send();
  }

}
