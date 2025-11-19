<?php

namespace App\Hooks\Contracts;

interface HookCollector
{
    /**
     * @return void
     */
    public function collect(): void;
}
