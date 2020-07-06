<?php
namespace Tests\Feature;

use App\User;
/* Debugging Responses Start */
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/* Debugging Responses End */

/* Upload Test Start */
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/* Upload Test End */

class HttpTest extends TestCase
{
    /**
     * Customizing Request Headers
     * @group request
     * @return void
     */
    public function httpRequest()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', '/user', ['name' => 'Sally']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }

    /**
    * Cookies
    * @group cookie
    */
    public function testCookies()
    {
        $response = $this->withCookie('color', 'blue')->get('/');
        $response = $this->withCookies([
            'color' => 'blue',
            'name' => 'Taylor',
        ])->get('/');
    }


    /**
    * Debugging Responses
    * @group response
    */
    public function testBasicTest()
    {
        $response = $this->get('/');
        $response->dumpHeaders();
        $response->dumpSession();
        $response->dump();
    }

    /**
    * Session / Authentication
    * @group session
    */
    public function testApplication()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/');

        // $response = $this->withSession(['foo' => 'bar'])
        //                  ->get('/');
    }

     /**
     * Testing JSON APIs
     * @group json
     * @return void
     */
    public function testJson()
    {
        $response = $this->postJson('/user', ['name' => 'Sally']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }

    /**
     * Verifying An Exact JSON Match
     * @group json
     */
    public function testExactJson()
    {
        $response = $this->json('POST', '/user', ['name' => 'Sally']);
        $response
            ->assertStatus(201)
            ->assertExactJson([
                'created' => true,
            ]);
    }

    /**
     * Verifying JSON Paths
     * @group json
     */
    public function testJsonPath()
    {
        $response = $this->json('POST', '/user', ['name' => 'Sally']);

        $response
            ->assertStatus(201)
            ->assertJsonPath('team.owner.name', 'foo')
    }

    /*
    *  Testing File Uploads
    *
    * @group upload
    */
    public function testAvatarUpload()
    {
        Storage::fake('avatars');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->json('POST', '/avatar', [
            'avatar' => $file,
        ]);

        // Assert the file was stored...
        Storage::disk('avatars')->assertExists($file->hashName());

        // Assert a file does not exist...
        Storage::disk('avatars')->assertMissing('missing.jpg');
    }
}
