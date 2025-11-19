<?php

namespace App\Blocks\Contracts;

interface BlockContract
{
    /**
     * @return string
     */
    public function render(): string;
}