<?php

namespace Chuva\Php\WebScrapping;

/**
 * Runner for the Webscrapping exercice.
 */
class Main {

  /**
   * Main runner, instantiates a Scrapper and runs.
   */
  public static function run(): void {
    

    $htmlFilePath = __DIR__ . '/../../assets/origin.html'; 
    $dom = new \DOMDocument('1.0', 'utf-8');
    $success = $dom->loadHTMLFile($htmlFilePath);

    if (!$success) {
        echo "Falha ao carregar o arquivo HTML.";
        return;
    }

   
    $scrapper = new Scrapper();

   
    $data = $scrapper->scrap($dom);

    
    print_r($data);
}

}
