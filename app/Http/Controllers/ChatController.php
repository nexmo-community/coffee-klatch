<?php


namespace App\Http\Controllers;


use App\Room;
use App\Services\RoomService;
use Illuminate\Http\Request;
use OpenTok\OpenTok;

class ChatController extends Controller
{
    private $openTok;
    private $roomService;

    public function __construct(OpenTok $openTok, RoomService $roomService)
    {
        $this->middleware('auth')->except('callback');
        $this->openTok = $openTok;
        $this->roomService = $roomService;
    }

    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->room) {
            $this->roomService->closeRoom($user->room);
        }

        $room = $this->roomService->findAvailableRoom();
        $this->roomService->addUserToRoom($user, $room);

        $openTokConfig = [
            'apiKey' => config('services.opentok.key'),
            'sessionId' => $room->session,
            'token' => $this->openTok->generateToken($room->session)
        ];

        return view('chat', $openTokConfig);
    }

    public function callback(Request $request)
    {
        $event = $request->get('event');
        if ($event === 'connectionDestroyed' && $room = Room::whereSession($request->get('sessionId'))->first()) {
            $this->roomService->closeRoom($room);
        }

        return "";
    }
}