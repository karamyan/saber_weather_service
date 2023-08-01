<?php

namespace Illuminate\Contracts\Auth\Access;

interface Authorizable
{
    /**
     * Determine if the Entities has a given ability.
     *
     * @param  iterable|string  $abilities
     * @param  array|mixed  $arguments
     * @return bool
     */
    public function can($abilities, $arguments = []);
}
