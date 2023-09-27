<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use DomainException;
use InvalidArgumentException;
use UnexpectedValueException;
 
class Authorize
{

    public function handle(Request $request, Closure $next)
    {
		$token = $request->cookie('sessionToken');
			
		if ($token === null) {
			return new JsonResponse(['error' => 'Not authorized'], 401);
			}

			return $this->validToken($request, $next, $token);
    }

    private function validToken($request, $next, $token)
    {
		// I know this shouldn't be here heheehe
		$secret = 'bananananana';

		try {
			$decoded = (array) JWT::decode($token, new Key($secret,'HS256'));
			return $next($request->merge(["JWT" => $decoded]));
		} catch (InvalidArgumentException $e) {
			return new JsonResponse($e->getMessage(), 400);
		} catch (DomainException $e) {
			return new JsonResponse($e->getMessage(), 400);
		} catch (SignatureInvalidException $e) {
			return new JsonResponse($e->getMessage(), 400);
		} catch (BeforeValidException $e) {
			return new JsonResponse($e->getMessage(), 400);
		} catch (ExpiredException $e) {
			return new JsonResponse($e->getMessage(), 400);
		} catch (UnexpectedValueException $e) {
			return new JsonResponse($e->getMessage(), 400);
		}
	
    }
    
}