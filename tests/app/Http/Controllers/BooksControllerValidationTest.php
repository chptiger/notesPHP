<?php

 namespace Tests\App\Http\Controllers;
 use TestCase;
 use Illuminate\Http\Response;
 use Illuminate\Foundation\Testing\DatabaseMigrations;

 class BooksControllerValidationTest extends TestCase {
     use DatabaseMigrations;
     /** @test **/
     public function it_validates_required_fields_when_creating_a_new_book() {
     }
     /** @test **/
     public function it_validates_requied_fields_when_updating_a_book() {
     }
 }