<?php

namespace App\Support;

class KependudukanSecurity
{
    /**
     * Produce a deterministic blind-index HMAC hash for sensitive NIK / No. KK values.
     */
    public static function hashIdentifier(string $value): string
    {
        $normalized = preg_replace('/\s+/', '', trim($value)) ?? '';

        return hash_hmac('sha256', $normalized, (string) config('app.key'));
    }

    /**
     * Mask sensitive national identifier strings for UU PDP compliant displays.
     */
    public static function maskIdentifier(?string $value): string
    {
        if (! $value) {
            return '—';
        }

        $clean = trim($value);
        $len = mb_strlen($clean);

        if ($len <= 8) {
            return str_repeat('•', max(4, $len - 2)).mb_substr($clean, -2);
        }

        return mb_substr($clean, 0, 6).str_repeat('•', $len - 10).mb_substr($clean, -4);
    }
}
