<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PriorityTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreatePriority()
    {
        // Creating new Priority
        //When
        $this->post('/priority/storing?name=Alta')
            //Then
            ->seeJson(['ok' => 'Successfully created Priority']);
    }

    public function testShowPriority()
    {
        //When
        $this->get('priority/showing/1')
            //Then
            ->seeJson(['ok' => 'Successfully find Priority 1']);
    }

    public function testUpdatePriority()
    {
        //When
        $this->post('priority/updating?id=1&name=Baja')
            //Then
            ->seeJson(['ok' => 'Successfully update Priority 1']);
    }

    public function testDeletePriority()
    {
        //When
        $this->post('priority/deleting/1')
            //Then
            ->seeJson(['ok' => 'Successfully delete Priority 1']);
    }
}
