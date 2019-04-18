<?php
namespace App\Model;
use RuntimeException;
use Illuminate\Hashing\HashManager;
use DB;
use Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Authenticator
{
    /**
     * The hasher implementation.
     *
     * @var \Illuminate\Hashing\HashManager
     */
    protected $hasher;
    /**
     * Create a new repository instance.
     *
     * @param  \Illuminate\Hashing\HashManager  $hasher
     * @return void
     */
    public function __construct(HashManager $hasher)
    {
        $this->hasher = $hasher->driver();
    }
    /**
     * @param string $username
     * @param string $password
     * @param string $provider
     * @return Authenticatable|null
     */
    public function attempt(
        string $email,
        string $provider
    ): ?Authenticatable {

        if (! $model = config('auth.providers.'.$provider.'.model')) {
            throw new RuntimeException('Unable to determine authentication model from configuration.');
        }
        /** @var Authenticatable $user */
        if (! $user = (new $model)->where('email', $email)->first()) {
            return null;
        }

        return $user;
    }

     public function attemptBuyer(
        string $email,
        string $password,
        string $provider
    ): ?Authenticatable {

        if (! $model = config('auth.providers.'.$provider.'.model')) {
            throw new RuntimeException('Unable to determine authentication model from configuration.gfdg');
        }
        /** @var Authenticatable $user */
        if (! $user = (new $model)->where('email', $email)->first()) {
            return null;
        }

        $buyer = DB::table('buyers')->where('email', $email)->value('password');

         if ( Hash::check($password,$buyer) == false ) {
            return null;
        }



        return $user;
    }



}
