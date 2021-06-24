<?php

namespace Drupal\evolent_contacts\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class ContactForm.
 *
 * @package Drupal\evolent_contacts\Form
 */
class ContactForm extends FormBase {
	
	/**
	* {@inheritdoc}
	*/
	public function getFormId() {
		return 'evolent_contacts_form';
	}

	/**
	* {@inheritdoc}
	*/
	public function buildForm(array $form, FormStateInterface $form_state) {
		$conn = Database::getConnection();
		$record = array();
		if (isset($_GET['num'])) {
			$query = $conn->select('evolent_contacts', 'm')
				->condition('id', $_GET['num'])
				->fields('m');
			$record = $query->execute()->fetchAssoc();
		}
		$form['first_name'] = array(
			'#type' => 'textfield',
			'#title' => t('First Name:'),
			'#required' => TRUE,
			'#default_value' => (isset($record['first_name']) && $_GET['num']) ? $record['first_name']:'',
		); 
		$form['last_name'] = array(
			'#type' => 'textfield',
			'#title' => t('Last Name:'),
			'#required' => TRUE,
			'#default_value' => (isset($record['last_name']) && $_GET['num']) ? $record['last_name']:'',
		); 
		$form['email'] = array(
			'#type' => 'email',
			'#title' => t('Email ID:'),
			'#required' => TRUE,
			'#default_value' => (isset($record['email']) && $_GET['num']) ? $record['email']:'',
		);
		$form['phone_number'] = array(
			'#type' => 'textfield',
			'#title' => t('Phone Number:'),
			'#default_value' => (isset($record['phone_number']) && $_GET['num']) ? $record['phone_number']:'',
		);
		$form['status'] = array (
			'#type' => 'select',
			'#title' => ('Status'),
			'#options' => array(
				'Active' => t('Active'),
				'Inactive' => t('Inactive'),
			),
			'#default_value' => (isset($record['status']) && $_GET['num']) ? $record['status']:'',
		);
		$form['submit'] = [
			'#type' => 'submit',
			'#value' => 'SAVE',
		];
		return $form;
	}

	/**
    * {@inheritdoc}
    */
	public function validateForm(array &$form, FormStateInterface $form_state) {
        $first_name = $form_state->getValue('first_name');
		
        if(preg_match('/[^A-Za-z]/', $first_name)) {
			$form_state->setErrorByName('first_name', $this->t('Your name must in characters without space'));
        }
		
		$last_name = $form_state->getValue('last_name');
        if(preg_match('/[^A-Za-z]/', $last_name)) {
			$form_state->setErrorByName('last_name', $this->t('Your name must in characters without space'));
        }

        if (strlen($form_state->getValue('phone_number')) != 10 ) {
			$form_state->setErrorByName('phone_number', $this->t('Your phone number must in 10 digits'));
        }
		parent::validateForm($form, $form_state);
	}

	/**
	* {@inheritdoc}
	*/
	public function submitForm(array &$form, FormStateInterface $form_state) {
		$field=$form_state->getValues();
		$first_name=$field['first_name'];
		$last_name=$field['last_name'];
		$email=$field['email'];
		$phone_number=$field['phone_number'];
		$status=$field['status'];
		
		if (isset($_GET['num'])) {
			$field  = array(
              'first_name'   => $first_name,
			  'last_name'   => $last_name,
              'email' =>  $email,
              'phone_number' =>  $phone_number,
			  'status' =>  $status,
			);
			$query = \Drupal::database();
			$query->update('evolent_contacts')
              ->fields($field)
              ->condition('id', $_GET['num'])
              ->execute();
			drupal_set_message("Successfully Updated");
			$form_state->setRedirect('evolent_contacts.display_table_controller_display');
		}
		else
		{
			$field  = array(
			  'first_name'   => $first_name,
			  'last_name'   => $last_name,
              'email' =>  $email,
              'phone_number' =>  $phone_number,
			  'status' =>  $status,
			);
			$query = \Drupal::database();
			$query ->insert('evolent_contacts')
               ->fields($field)
               ->execute();
			drupal_set_message("Successfully Saved");

			$response = new RedirectResponse("/drupal-8.6.16/evolent_contacts/display-contacts");
			$response->send();
		}
    }
}
