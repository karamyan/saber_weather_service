<?php

namespace Illuminate\Contracts\Translation;

interface HasLocalePreference
{
    /**
     * Get the preferred locale of the Entities.
     *
     * @return string|null
     */
    public function preferredLocale();
}
