<?php

use vaquitapp\Events\TestingEventHandler;

//Eventos del sistema, listos para registrar en redis
Event::listen(TestingEventHandler::EVENT, 'UpdateScoreEventHandler');