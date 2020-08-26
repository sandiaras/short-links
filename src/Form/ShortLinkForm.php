<?php

namespace Drupal\custom_short_links\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ShorLinkForm.
 */
class ShortLinkForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'short_link_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['long_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Long Url'),
      '#description' => $this->t('Enter the long url. Ex.: http://mi-site.com/abc'),
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

    $longUrl = $form_state->getValue('long_url');
    if (!filter_var($longUrl, FILTER_VALIDATE_URL)) {
      $form_state->setErrorByName('long_url', $this->t('Invalid URL'));
    }

    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $length = rand(5,8);
    $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';

    $shortUrl = substr(str_shuffle($data), 0, $length);

    $database = \Drupal::service('database');
    $result = $database->insert('short_links')
        ->fields([
          'long_url' => $form_state->getValue('long_url'),
          'short_url' => $shortUrl
        ])
        ->execute();

    $dialogText = "Your new user ID: $result";

    \Drupal::messenger()->addMessage($dialogText);

  }

}
