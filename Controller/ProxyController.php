<?php

namespace Ds\Bundle\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class ProxyController
 *
 * @Route("/proxy")
 */
class ProxyController extends Controller
{
    /**
     * Rest action
     *
     * @Route("/rest/{resource}", requirements={"resource"=".+"})
     */
    public function restAction($resource)
    {
        $request = $this->get('request');
        $method = $request->getMethod();
        $parameters = $request->query->all();
        $content = $request->getContent();

        $logger = $this->get('logger');
        $logger->info(sprintf('Proxy access "%s" "%s"', $method, $resource));

        $user = $parameters['user'];
        $key = $parameters['key'];
        $nonce = uniqid();
        $created = date('c');
        $digest = base64_encode(sha1(base64_decode($nonce) . $created . $key, true));

        $wsse = 'Authorization: WSSE profile="UsernameToken"' . "\n";
        $wsse .= sprintf('X-WSSE: UsernameToken Username="%s", PasswordDigest="%s", Nonce="%s", Created="%s"', $user, $digest, $nonce, $created);

        $baseUrl = 'http://platform.ds.dev/app_dev.php/api/rest/';
        $client = new \Guzzle\Http\Client($baseUrl);
        $response = $client->{strtolower($method)}($resource, [ $wsse ], $content)->send();
        $data = json_decode($response->getBody());

        return new JsonResponse($data, $response->getStatusCode());
    }
}

