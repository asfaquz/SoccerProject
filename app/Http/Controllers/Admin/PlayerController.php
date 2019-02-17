<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Log;
//use Exception;
use Carbon\Carbon;
use App\Models\Players as Player;
use App\Models\PlayerToTeamMapping as PlayerTeamMap;
use App\Models\Team;

class PlayerController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        try {
            $data = Player::all()->toArray();
            return view('player.index', ['players' => $data]);
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            Log::error('Error :', $errorMsg);
        }
    }

    public function create() {
        $teams = Team::all('id', 'name')->toArray();
        return view('player.create', ['teams' => $teams]);
    }

    /**
     * Store Team Into Db
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $message = '';
        try {
            /**
             * Validate The Team Form and Store
             */
            $validatedData = $this->validate($request, [
                'fname' => 'required|max:100',
                'lname' => 'required|max:100',
                'team' => 'required',
                'imageUri' => 'required',
                'created_at' => 'nullable|date',
                'updated_at' => 'nullable|date'
            ]);
            $data = ['fname' => $request->fname, 'lname' => $request->lname, 'teamId' => $request->team, 'imageUri' => $request->imageUri, 'created_at' => \Carbon::now()];
            Log::info('Status :: store', ['message' => 'Player Created Successfully', 'params' => $data]);
            $playerModelObj = new Player();
            $playerModelObj->firstName = $request->fname;
            $playerModelObj->lastName = $request->lname;
            $playerModelObj->imageUri = $request->imageUri;
            $playerModelObj->created_at = \Carbon::now();
            $playerModelObj->save();
            $lastInsertedId = $playerModelObj->id;
            if ($lastInsertedId) {
                $playerTeamMapObj = new PlayerTeamMap();
                $playerTeamMapObj->team_id = $request->team;
                $playerTeamMapObj->player_id = $lastInsertedId;
                $playerTeamMapObj->created_at = \Carbon::now();
                $playerTeamMapObj->save();
                $message = 'Player Added Successfully !!';
                Log::info('Status :: ', ['message' => $message, 'params' => $data]);
            }
        } catch (Exception $e) {
            $message = 'Error:' . $e->getMessage();
            Log::error('Error :', ['message' => $e->getMessage()]);
        }
        return redirect()->route('admin.player')->with('message', $message);
    }

    public function delete($id) {
        $message = "";
        if (!empty($id)) {
            try {
                $playerObj = Player::find($id)->toArray();
                if ($playerObj) {
                    PlayerTeamMap::where('player_id', '=', $id)->firstOrFail()->delete();
                    Player::findOrFail($id)->delete();
                    $playerName = $playerObj['firstName'] . ' ' . $playerObj['lastName'];
                    $message = "Player : $playerName deleted successfully.";
                    Log::info("Status ::", ['message' => $message]);
                } else {
                    throw new Exception("Invalid data");
                }
            } catch (Exception $e) {
                $message = "Error ::" . $e->getMessage();
                Log::error('Delete failed', ['reason' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            }
        }
        return redirect()->route('admin.player')->with('message', $message);
    }

    public function edit($id) {
        if (!empty($id)) {
            try {
                $playerObj = Player::find($id);
                if ($playerObj) {
                    $data = $playerObj->toArray();
                    $playerTeam = PlayerTeamMap::where('player_id', '=', $id)->first();
                    $selectedTeamId = 0;
                    if (!empty($playerTeam)) {
                        $selectedTeamId = $playerTeam->toArray()['team_id'];
                    }
                    $teams = Team::all('id', 'name')->toArray();
                    return view('player.update', ['player' => $data, 'selectedTeamId' => $selectedTeamId, 'teams' => $teams]);
                } else {
                    Log::info('Edit failed ', ['message' => "Invalid Data"]);
                }
            } catch (Exception $e) {
                Log::error('Edit failed', ['reason' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            }
        }
    }

    public function update(Request $request, $id) {
        $message = '';
        try {
            /**
             * Validate The Team Form and Store
             */
            $validatedData = $this->validate($request, [
                'fname' => 'required|max:100',
                'lname' => 'required|max:100',
                'team' => 'required',
                'imageUri' => 'required',
                'created_at' => 'nullable|date',
                'updated_at' => 'nullable|date'
            ]);
            $data = ['fname' => $request->fname, 'lname' => $request->lname, 'teamId' => $request->team, 'imageUri' => $request->imageUri, 'created_at' => \Carbon::now()];
            $playerObj = Player::find($id);
            $playerObj->firstName = $request->fname;
            $playerObj->lastName = $request->lname;
            $playerObj->imageUri = $request->imageUri;
            $playerObj->updated_at = \Carbon::now();
            $playerObj->save();
            $playerName = $request->fname . ' ' . $request->lname;
            $playerTeam = PlayerTeamMap::where('player_id', '=', $id)->first();
            if ($playerTeam) {
                $playerTeam = $playerTeam->toArray();
                $playerTeamId = $playerTeam['id'];
                $playerTeamMapObj = PlayerTeamMap::find($playerTeamId);
                $playerTeamMapObj->team_id = $request->team;
                $playerTeamMapObj->updated_at = \Carbon::now();
                $playerTeamMapObj->save();
            } else {
                $playerTeamMapObj = new PlayerTeamMap();
                $playerTeamMapObj->team_id = $request->team;
                $playerTeamMapObj->player_id = $id;
                $playerTeamMapObj->updated_at = \Carbon::now();
                $playerTeamMapObj->save();
            }
            $message = "$playerName Updated Successfully !!";
            Log::info('Status :: store', ['message' => $message, 'params' => $data]);
        } catch (Exception $e) {
            $message = $e->getMessage();
            Log::error('Error ::', ['message' => $e->getMessage()]);
        }
        return redirect()->route('admin.player')->with('message', $message);
    }

}
