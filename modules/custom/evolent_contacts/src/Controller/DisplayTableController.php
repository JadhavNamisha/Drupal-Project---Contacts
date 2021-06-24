<?php

namespace Drupal\evolent_contacts\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;

/**
 * Class DisplayTableController.
 *
 * @package Drupal\evolent_contacts\Controller
 */
class DisplayTableController extends ControllerBase {
	
  public function getContent() {
    $build = [
      'description' => [
        '#theme' => 'evolent_contacts_description',
        '#description' => 'Contacts Description',
        '#attributes' => [],
      ],
    ];
    return $build;
  }

  /**
   * Display.
   *
   * @return string
   * 
   */
  public function display() {

    /* Create table header */
    $header_table = array(
      'first_name' => t('First Name'),
	  'last_name' => t('Last Name'),
      'email'=>t('Email'),
      'phone_number' => t('Phone Number'),
	  'status' => t('Status'),
      'opt' => t('operations'),
      'opt1' => t('operations'),
    );

	/* Select records from table */
    $query = \Drupal::database()->select('evolent_contacts', 'm');
    $query->fields('m', ['id','first_name','last_name','email','phone_number','status']);
    $results = $query->execute()->fetchAll();
    $rows=array();
	
    foreach($results as $data){
        $delete = Url::fromUserInput('/evolent_contacts/form/delete/'.$data->id);
        $edit   = Url::fromUserInput('/evolent_contacts/form/evolent_contacts?num='.$data->id);

		/* Print data */
        $rows[] = array(
			'first_name' => $data->first_name,
			'last_name' => $data->last_name,
			'email' => $data->email,
			'phone_number' => $data->phone_number,
			'status' => $data->status,
			\Drupal::l('Delete', $delete),
			\Drupal::l('Edit', $edit),
        );
    }
    /* Display records */
    $form['table'] = [
        '#type' => 'table',
        '#header' => $header_table,
        '#rows' => $rows,
        '#empty' => t('No users found'),
    ];
    return $form;
  }
}
