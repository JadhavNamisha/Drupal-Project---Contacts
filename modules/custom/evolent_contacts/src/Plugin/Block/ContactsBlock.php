<?php

namespace Drupal\evolent_contacts\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'ContactsBlock' block.
 *
 * @Block(
 *  id = "contacts_block",
 *  admin_label = @Translation("Evolent Contacts block"),
 * )
 */
class ContactsBlock extends BlockBase {

	/**
	* {@inheritdoc}
	*/
	public function build() {
		$form = \Drupal::formBuilder()->getForm('Drupal\evolent_contacts\Form\ContactForm');
		return $form;
	}
}
