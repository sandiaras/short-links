<?php

namespace Drupal\custom_short_links\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;

/**
 * Class ShowShortLinkController.
 */
class ShowShortLinkController extends ControllerBase {

  /**
   * Show.
   *
   * @return string
   *   Return Hello string.
   */
  public function show($shortLink) {

    $host = \Drupal::request()->getSchemeAndHttpHost();
    $urlShortLink = $host.'/'.$shortLink;

    $url = Url::fromUri($urlShortLink);

    $output['link'] = array(
      '#prefix' => '<p>Please copy your new short code:</p>',
      '#theme'  => 'markup',
      '#markup' => '<h2>'.\Drupal::l($urlShortLink, $url).'</h2>',

    );

    $output['image'] = array(
      '#prefix' => "<p>Here's  the QR Code for the short link:</p>",
      '#theme' => 'image',
      '#alt'   => 'qr code',
      '#title' => 'qr code',
      '#uri'   => 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . $urlShortLink,
    );

    return $output;
  }

}
