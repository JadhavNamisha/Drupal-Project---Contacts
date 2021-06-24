<?php

namespace Drupal\evolent_contacts\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class ContactsController.
 *
 * @package Drupal\evolent_contacts\Controller
 */
class ContactsController extends ControllerBase {

  /**
   * Display.
   *
   * @return string
   * 
   */
  public function display() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Please enter the details given below: ')
    ];
  }

}
