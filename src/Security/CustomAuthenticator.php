<?php

namespace App\Security;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

class CustomAuthenticator extends AbstractAuthenticator
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function authenticate(Request $request): Passport
    {
        $email = $request->request->get('email');
        $plaintextPassword = $request->request->get('password');

        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($plaintextPassword)
        );
    }

    public function supports(Request $request): ?bool
    {
        // TODO: Implement supports() method.
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // TODO: Implement onAuthenticationSuccess() method.
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        // TODO: Implement onAuthenticationFailure() method.
    }
}