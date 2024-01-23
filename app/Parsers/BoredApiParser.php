<?php

namespace App\Parsers;
use Illuminate\Support\Facades\Http;

class BoredApiParser extends AbstractHandler
{
    private int $limit;

    public function __construct(int $limit = 1)
    {
        $this->limit = $limit;
    }

    /**
     * @throws \Exception
     */
    public function handle() : array|HandlerInterface
    {
        $data = [];

        for ($i = 0; $i < $this->limit; $i++) {
            try {
                $result = Http::get('https://www.boredapi.com/api/activity');
            } catch (\Exception $e) {
                return $data;
            }
            if(!$result->ok()){
                return $data;
            }
            $data[] = $result->json();
        }
        usort($data, fn($a, $b) => $b['key'] <=> $a['key']);
        return $data;
    }
}
