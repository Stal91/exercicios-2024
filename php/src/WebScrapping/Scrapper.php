<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Entity\Paper;
use Chuva\Php\WebScrapping\Entity\Person;

/**
 * Does the scrapping of a webpage.
 */
/**
 * Loads paper information from the HTML and returns the array with the data.
 */
 function scrap(\DOMDocument $dom): array {
  // Create an XPath instance to query the DOM
  $xpath = new \DOMXPath($dom);

  // Initialize an empty array to store paper objects
  $papers = [];

  // Query the DOM for paper elements
  $paperNodes = $xpath->query('//div[@class="paper"]');

  // Loop through each paper element
  foreach ($paperNodes as $paperNode) {
      // Extract paper information
      $id = $xpath->query('.//span[@class="paper-id"]', $paperNode)->item(0)->textContent;
      $title = $xpath->query('.//h2[@class="paper-title"]', $paperNode)->item(0)->textContent;
      $type = $xpath->query('.//span[@class="paper-type"]', $paperNode)->item(0)->textContent;

      // Extract author information
      $authorNodes = $xpath->query('.//div[@class="author"]', $paperNode);
      $authors = [];
      foreach ($authorNodes as $authorNode) {
          $name = $xpath->query('.//span[@class="author-name"]', $authorNode)->item(0)->textContent;
          $affiliation = $xpath->query('.//span[@class="author-affiliation"]', $authorNode)->item(0)->textContent;
          $authors[] = new Person($name, $affiliation);
      }

      // Create a Paper object and add it to the array
      $papers[] = new Paper($id, $title, $type, $authors);
  }

  return $papers;
}

