<?php
namespace App\Middleware;

class Test
{
    public function handle()
    {
        // Example logic
        
        echo 'from middleware';
        return true;
    }
}
