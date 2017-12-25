<?php
namespace phpunit\Gap\Dto;

use PHPUnit\Framework\TestCase;

class DtoTest extends TestCase
{
    public function testDto(): void
    {
        $nick = 'hhhh';
        $userId = base64_encode(random_bytes(32));
        $created = new \DateTime();
        $createdStr = $created->format('Y-m-d H:i:s');

        $user = new UserDto([
            'userId' => $userId,
            'nick' => $nick,
            'created' => $createdStr
        ]);

        $this->assertEquals($nick, $user->nick);
        $this->assertEquals($userId, $user->userId);
        $this->assertEquals($createdStr, $user->created);

        $arr =  json_decode(json_encode($user), true);

        $this->assertEquals($nick, $arr['nick']);
        $this->assertEquals($userId, $arr['userId']);
        $this->assertEquals($createdStr, $arr['created']);
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
