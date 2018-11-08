<?php


namespace App\Services;


use App\Room;
use App\User;
use OpenTok\OpenTok;

class RoomService
{
    private $openTok;

    public function __construct(OpenTok $openTok)
    {
        $this->openTok = $openTok;
    }

    public function closeRoom(Room $room)
    {
        /**
         * @var User $user
         */
        foreach ($room->users as $user) {
            $user->room()->dissociate();
            $user->save();
        }

        $room->delete();
    }

    public function findAvailableRoom(): Room
    {
        return Room::has('users', '<', 2)->get()->shuffle()->first() ?? $this->buildNewRoom();
    }

    private function buildNewRoom(): Room
    {
        $session = $this->openTok->createSession();

        $room = new Room;
        $room->session = $session->getSessionId();
        $room->save();

        return $room;
    }

    public function addUserToRoom(User $user, Room $room)
    {
        $user->room()->associate($room);
        $user->save();
    }

}