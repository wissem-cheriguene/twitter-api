<?php
namespace App\Service;
use Abraham\TwitterOAuth\TwitterOAuth;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class TwitterApiService
{
  private $params;

  public function __construct(ParameterBagInterface $params)
  {
    $this->params = $params;
  }

  public function post(string $content)
  {
    $consumer_key = $this->params->get("TWITTER_CONSUMER_KEY");
    $consumer_secret = $this->params->get("TWITTER_CONSUMER_SECRET");
    $access_token = $this->params->get("TWITTER_ACCESS_TOKEN");
    $access_token_secret = $this->params->get("TWITTER_ACCESS_TOKEN_SECRET");
    $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
    $connection->post("statuses/update", ["status" => $content]);
  }
}
