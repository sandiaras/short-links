<?php

namespace Drupal\custom_short_links\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Routing\TrustedRedirectResponse;

/**
 * Class RedirectShortLinkController.
 */
class RedirectShortLinkController extends ControllerBase {

  /**
   * Redirect.
   *
   * @return string
   *   Return Hello string.
   */
  public function redirect($shortLink) {

    $result = \Drupal::database()->select('short_links', 's')
      ->fields('s', array('long_url', 'views'))
      ->condition('s.short_url', $shortLink)
      ->execute()
      ->fetchAll();

    if(count($result)==1){

      $query = \Drupal::database()->update('short_links')
        ->condition('short_url', $shortLink)
        ->expression('views', $result[0]->views+1)
        ->execute();

      return new TrustedRedirectResponse($result[0]->long_url);

    }else{

      $output['output'] = array(
        '#markup' => '<h4>'.$this->t('Wrong short link').'</h4>'
      );

      return $output;
    }

  }

}
