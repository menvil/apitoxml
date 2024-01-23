<?php

namespace App\Parsers;
use Illuminate\Support\Facades\Http;

class RandomUserParser extends AbstractHandler
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
        try {
            $result = Http::get('https://randomuser.me/api', [
                'results' => $this->limit,
                'page' => 1,
                'inc' => 'name,phone,email,country'
            ]);
        } catch (\Exception $e) {
            return $this->next();
        }
        if(!$result->ok()){
            return $this->next();
        }
        $data = $result->json()['results'];
        usort($data, fn($a, $b) => $b['name']['last'] <=> $a['name']['last']);
        return $data;
    }
}
