<?php
namespace phpunit\Gap\Dto;

use PHPUnit\Framework\TestCase;
use Gap\Dto\DateTime;

class UserDtoTest extends TestCase
{
    public function testDto(): void
    {
        $nick = 'hhhh';
        $userId = base64_encode(random_bytes(32));
        $created = new DateTime('2018-3-20 15:16:17');

        $user = new UserDto([
            'userId' => $userId,
            'nick' => $nick,
            'created' => $created
        ]);

        $this->assertEquals($nick, $user->nick);
        $this->assertEquals($userId, $user->userId);
        $this->assertEquals($created, $user->created);

        $arr =  json_decode(json_encode($user), true);
        $this->assertEquals($nick, $arr['nick']);
        $this->assertEquals($userId, $arr['userId']);
        $this->assertEquals(
            $created->format('Y-m-d H:i:s.u'),
            $arr['created']
        );
    }

    /**
     * @expectedException OutOfBoundsException
     */
    public function testException(): void
    {
        $user = new UserDto([
            'notExists' => 3
        ]);

        // will throw exception before
        $this->assertNull($user);
    }
}
