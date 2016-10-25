<?php

 namespace Tests\App\Transformer;

 use TestCase;
 use App\Book;
 use App\Transformer\BookTransformer;
 use League\Fractal\TransformerAbstract;

 class BookTransformerTest extends TestCase
 {
    use DatabaseMigrations;

     /** @test **/
     public function it_can_be_initialized()
     {
                $subject = new BookTransformer();
                $this->assertInstanceOf(TransformerAbstract::class, $subject);
     }
 }