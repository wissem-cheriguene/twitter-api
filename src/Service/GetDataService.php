<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GetDataService
{
  private $client;
  public function __construct(HttpClientInterface $client)
  {
    $this->client = $client;
  }

  public function fromGouv():string
  {
    $response = $this->client->request(
      'GET',
      'https://www.data.gouv.fr/fr/datasets/r/131c6b39-51b5-40a7-beaa-0eafc4b88466'
    );
    $content = str_getcsv($response->getContent(),';');
    $date = $content[7];
    $date = str_replace('-','/',$date);
    $tot_vacsi = $content[8];

    return 'Au ' .  $date . ' il y a ' . $tot_vacsi . ' personnes vaccinées en France. Message envoyé depuis l\'API de Twitter !';
  }
}
