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
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: view: '.$shortLink)
    ];
  }

}
