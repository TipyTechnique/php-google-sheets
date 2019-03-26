<?php

namespace Tipy\Google\Sheets\Traits;

use Illuminate\Container\Container;
use Tipy\Google\Sheets\Contracts\Factory;

/**
 * use at User model
 */
trait GoogleSheets
{
    /**
     * @return Factory
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function sheets()
    {
        $token = $this->sheetsAccessToken();

        return Container::getInstance()->make(Factory::class)->setAccessToken($token);
    }

    /**
     * Get the Access Token
     *
     * @return string|array
     */
    abstract protected function sheetsAccessToken();
}
