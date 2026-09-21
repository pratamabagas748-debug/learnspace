<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Setup dasar: nonaktifkan Vite agar test tidak memerlukan dev server.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }
}
