<?php

namespace Drupal\evolent_contacts\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Url;
use Drupal\Core\Render\Element;
/**
 * Class DeleteForm.
 *
 * @package Drupal\evolent_contacts\Form
 */
class DeleteForm extends ConfirmFormBase {

  /**
   * {@inheritdoc}
   */
	public function getFormId() {
		return 'delete_form';
	}
  
	public $cid;
  
	public function getQuestion() { 
		return t('Do you want to delete %cid?', array('%cid' => $this->cid));
	}

	public function getCancelUrl() {
		return new Url('evolent_contacts.display_table_controller_display');
	}
	public function getDescription() {
		return t('Are you sure you want to delete it?');
	}

	/**
	* {@inheritdoc}
	*/
	public function getConfirmText() {
		return t('Delete it!');
	}

	/**
	* {@inheritdoc}
	*/
	public function getCancelText() {
		return t('Cancel');
	}

	/**
	* {@inheritdoc}
	*/
	public function buildForm(array $form, FormStateInterface $form_state, $cid = NULL) {
		$this->id = $cid;
		return parent::buildForm($form, $form_state);
	}

	/**
    * {@inheritdoc}
    */
	public function validateForm(array &$form, FormStateInterface $form_state) {
		parent::validateForm($form, $form_state);
	}

	/**
	* {@inheritdoc}
	*/
	public function submitForm(array &$form, FormStateInterface $form_state) {
		$query = \Drupal::database();
		$query->delete('evolent_contacts')
			->condition('id',$this->id)
			->execute();
        drupal_set_message("Successfully Deleted");
		$form_state->setRedirect('evolent_contacts.display_table_controller_display');
	}
}
