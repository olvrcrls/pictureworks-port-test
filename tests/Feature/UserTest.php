<?php

namespace Tests\Feature;

use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $promptPassword;

    protected function setUp() : void
    {
        parent::setUp();
        $this->user = new UserRepository;
        $this->promptPassword = '720DF6C2482218518FA20FDC52D4DED7ECC043AB';
    }
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_user_comment_is_appended()
    {
        $newUser = $this->user->first_or_create(array(
            'name' => 'John Doe',
            'comments' => 'First Comment',
            'password' => $this->promptPassword
        ));
        $this->assertTrue($newUser->comments == 'First Comment', "Invalid comment.");

        $appendComment = "Appended Comment";

        $newUser = $this->user->create_or_update(['comments' => $appendComment, 'password' => $this->promptPassword], $newUser->id);

        $this->assertTrue($newUser->name === 'John Doe', "User does not exist.");

        $this->assertTrue($newUser->comments === "First Comment\nAppended Comment", "User comment is {$newUser->comments} | Required output: {$newUser->comments}\n{$appendComment}");
    }
}
