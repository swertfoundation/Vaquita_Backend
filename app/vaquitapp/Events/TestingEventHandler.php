<?php namespace vaquitapp\Events;

class TestingEventHandler {
 
    CONST EVENT = 'score.update';
    CONST CHANNEL = 'score.update';
 
    public function handle($data)
    {
        $redis = Redis::connection();
        $redis->publish(self::CHANNEL, $data);
    }
}