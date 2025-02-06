<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TldServers extends Enum
{
    const COM = ['whois.verisign-grs.com', 'whois.centralnic.com', 'whois.centralnic.net'];
    const UA = ['whois.ua'];

    /**
     * @param string $domain
     * @return array|null
     */
    public static function listServers(string $domain): array|null
    {
        try {
            $tmp = explode('.', $domain);
            return self::getValue(strtoupper(end($tmp)));
        } catch (\ErrorException $e) {
            return null;
        }
    }
}
