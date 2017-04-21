<?php

namespace Ahmedash95\LogWriter\Test;

class LogWriterTest extends TestCase
{
    public function test_log_is_writing_to_channel()
    {
        $this->logWriter->write('event', 'Test Event');
        $testFile = $this->getTempDir().'/logs/event.log';
        $this->assertFileExists($testFile);
        $this->assertContains('event.INFO: Test Event [] []', file_get_contents($testFile));
    }

    public function test_log_type_is_writing_to_channel()
    {
        $this->logWriter->info('event', 'Test Event');
        $this->logWriter->alert('event', 'Test Event');
        $testFile = $this->getTempDir().'/logs/event.log';
        $this->assertFileExists($testFile);
        $this->assertContains('event.ALERT: Test Event [] []', file_get_contents($testFile));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function test_throw_exception_on_invalid_channel_name()
    {
        $this->logWriter->write('dummy', 'Test Event');
    }
}
