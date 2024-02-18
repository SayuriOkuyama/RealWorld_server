<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
  /**
   * A basic test example.
   */
  public function testTheApplicationReturnsASuccessfulResponse(): void
  {
    $response = $this->get('https://apprentice.my-raga-bhakti.com/');

    $response->assertStatus(200);
  }
}
