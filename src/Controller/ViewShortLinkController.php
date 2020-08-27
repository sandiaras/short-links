<?php

namespace Drupal\custom_short_links\Controller;

use Drupal\Core\Controller\ControllerBase;


/**
 * Class ViewShortLinkController.
 */
class ViewShortLinkController extends ControllerBase {

  /**
   * View.
   *
   * @return string
   *   Return Hello string.
   */
  public function view($shortLink) {

    $result = \Drupal::database()->select('short_links', 's')
      ->fields('s', array('slid', 'date', 'long_url','short_url', 'views'))
      ->condition('s.short_url', $shortLink)
      ->execute()
      ->fetchAll();


    if(count($result)==1){

      $host = \Drupal::request()->getSchemeAndHttpHost();
      $urlShortLink = $host.'/'.$shortLink;
      $result[0]->short_url = $urlShortLink;

      $rows[] = ['data' => $result[0]];

      $output['table'] = array(
        '#theme'  => 'table',
        '#header' => ['Id', 'Registered','Long URL','Short URL','# Views'],
        '#rows'   => $rows
      );

      $output['image'] = array(
        '#prefix' => '<h6>QR Code for the short link:</h6>',
        '#theme' => 'image',
        '#alt'   => 'QR code',
        '#title' => 'QR code',
        '#uri'   => 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . $urlShortLink,
      );

    }else{
      $output['output'] = array(
        '#markup' => '<h4>'.$this->t('Wrong short link id').'</h4>'
      );
    }

    return $output;
  }

}
