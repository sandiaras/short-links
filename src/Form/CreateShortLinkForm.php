<?php

namespace Drupal\custom_short_links\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Class CreateShortLinkForm.
 */
class CreateShortLinkForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'create_short_link_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['long_url'] = [
      '#type'        => 'textfield',
      '#title'       => $this->t('Long Url'),
      '#description' => $this->t('Enter the long url like: http://mi-site.com/abc'),
    ];

    $form['submit'] = [
      '#type'  => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }


  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

    $longUrl = $form_state->getValue('long_url');

    // apply filter to check the url
    if (!filter_var($longUrl, FILTER_VALIDATE_URL)) {
      $form_state->setErrorByName('long_url', $this->t('Invalid URL'));
    }

    parent::validateForm($form, $form_state);
  }


  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    // it must a string with 5 to 8 chars
    $length = rand(5,8);

    // allowed chars
    $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';

    $shortUrl = substr(str_shuffle($data), 0, $length);

    // store the string generated to 'short_links' table
    $database = \Drupal::service('database');

    $database->insert('short_links')
        ->fields([
          'long_url'  => $form_state->getValue('long_url'),
          'short_url' => $shortUrl
        ])
        ->execute();

    // creating a new alias to manage the url
    // @see \Drupal\custom_short_links\Controller\RedirectShortLinkController::redirect
    \Drupal::service('path.alias_storage')->save("/redirect/" . $shortUrl, "/" . $shortUrl);

    // url to show the new short link created
    $url = Url::fromUserInput('/show/'.$shortUrl);

    $form_state->setRedirectUrl($url);

  }

}
