<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Rules\Domain;
use App\Enums\TldServers;

class WhoisService
{
    private string|null $domain = null;
    private array|null $servers = null;

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct()
    {
        if ($this->domain = request()->get('domain', null)) {
            $this->domain = trim(strtolower(str_replace('www.', '', $this->domain)));
            $this->servers = TldServers::listServers($this->domain);
        }
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $validator = Validator::make([
            'domain' => $this->domain,
            'servers' => $this->servers
        ],
            [
                'domain' => [
                    'required',
                    new Domain
                ],
                'servers' => ['required']
            ],
            [
                'domain.required' => trans('whois.errors.domain_required'),
                'servers.required' => trans('whois.errors.domain_required')
            ]);
        if ($validator->fails()) {
            return [
                'status' => 'error',
                'code' => 400,
                'messages' => $validator->errors(),
            ];
        }

        return $this->getWhois();
    }

    /**
     * @return array
     */
    private function getWhois()
    {
        $result = [
            'status' => 'error',
            'code' => 400,
            'messages' => trans('whois.errors.not_response'),
        ];
        $content = "";
        foreach ($this->servers as $server) {
            $sock = @fsockopen($server, 43, $errno, $errstr, 10);
            if (!$sock) {
                $result['messages'] = ["{$errstr} ({$errno})"];
            } else {
                fputs($sock, $this->domain . "\r\n");
                $content = "";
                while (!feof($sock)) {
                    $content .= fgets($sock);
                }
                fclose($sock);
                if (!str_contains($content, 'No match for')) {
                    break;
                }
            }
        }

        if (!empty($content)) {
            $result = [
                'status' => 'success',
                'code' => 200,
                'data' => $content,
            ];
        }
        return $result;
    }
}
