<?php
/**
 * @file
 * Contains \Drupal\contact_link|Plugin\ds\DsField\User\Contact.
 */

namespace Drupal\contact_link\Plugin\DsField;

use Drupal\Core\Url;
use Drupal\ds\Plugin\DsField\Link;

/**
 * Plugin that renders a contact form link.
 *
 * @DsField(
 *   id = "contact_link",
 *   title = @Translation("Personal Contact Form Link"),
 *   entity_type = "user",
 *   provider = "user"
 * )
 */
class Contact extends Link {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();

    $url = Url::fromRoute('entity.user.contact_form', [
      'user' => $this->entity()->id(),
    ]);

    if (!$url->access()) {
      return [];
    }

    $output = [
      '#type' => 'link',
      '#title' => $config['link text'],
      '#url' => $url,
    ];

    // Wrapper and class.
    if (!empty($config['wrapper'])) {
      return [
        '#type' => 'html_tag',
        '#tag' => $config['wrapper'],
        '#attributes' => [
          'class' => explode(' ', $config['class']),
        ],
        '#value' => $output,
      ];
    }
    else {
      return $output;
    }

  }

  /**
   * {@inheritdoc}
   */
  public function isAllowed() {
    if (\Drupal::moduleHandler()->moduleExists('contact')) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    $configuration = parent::defaultConfiguration();

    $configuration['link text'] = \Drupal::translation()->translate('Contact');

    return $configuration;
  }

}
