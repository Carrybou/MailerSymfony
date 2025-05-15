<?php
namespace App\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;

class ApiAuthenticator extends AbstractAuthenticator
{
public function __construct(
// injection des variables d'environnement
) {
}

public function supports(Request $request): ?bool
{
return true;
}

public function authenticate(Request $request): Passport|SelfValidatingPassport
{
// Vérification de la présence de la clé custom dans le header

// Vérication que la valeur de la clé correspond à la passphrase

// Retour d'un passeport avec un badge custom
return new SelfValidatingPassport(new UserBadge('api_user'));
}

public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
{
return null;
}

public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
{
$message = sprintf("Unauthorized : %s", $exception->getMessage());
return new JsonResponse($message, Response::HTTP_UNAUTHORIZED);
}
}

