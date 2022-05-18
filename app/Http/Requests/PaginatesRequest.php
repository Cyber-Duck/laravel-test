<?php

namespace App\Http\Requests;

trait PaginatesRequest
{
    public function page(): int
    {
        return max(1, (int) ($this->input('page', 1) ?? 1));
    }

    public function perPage(): int
    {
        $perPage = (int) ($this->input('per_page', 10) ?? 10);

        return max(1, min($perPage, 50));
    }
}
