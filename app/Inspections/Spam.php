<?php

namespace App\Inspections;

use Illuminate\Database\Eloquent\Model;

class Spam
{
    /**
     * @param $body
     * @throws \Exception
     */
    public function detect($body)
    {
        // Detect invalid keywords

        $this->detectInvalidKeywords($body);
        $this->detectKeyHeldDown($body);

        return false;
    }

    /**
     * @param $body
     * @throws \Exception
     */
    protected function detectInvalidKeywords($body)
    {
        $invalidKeywords = [
            'Yahoo Customer Support'
        ];

        foreach( $invalidKeywords as $keyword)
        {
            if(stripos($body, $keyword) !== false)
            {
                throw new \Exception('Your reply contains spam.');
            }
        }
    }

    /**
     * @param $body
     * @throws \Exception
     */
    protected function detectKeyHeldDown($body)
    {
        if(preg_match( '/(.)\\1{4,}/' , $body)){
            throw new \Exception('Your reply contains spam.');
        }
    }
}
