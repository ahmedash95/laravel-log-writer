<?php

namespace Ahmedash95\LogWriter\Facades;


use Ahmedash95\LogWriter\LogWriter;
use Illuminate\Support\Facades\Facade;
class LogWriterFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'logwriter';
    }
}