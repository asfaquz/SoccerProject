<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Log;
use Exception;
use Carbon\Carbon;
use App\Models\Team;

class TeamController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        try {
            $data = Team::all()->toArray();
            return view('team.index', ['teams' => $data]);
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            Log::error('Error :', $errorMsg);
        }
    }

    public function create() {
        return view('team.create');
    }

    /**
     * Store Team Into Db
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        try {
            /**
             * Validate The Team Form and Store
             */
            $validatedData = $this->validate($request, [
                'name' => 'bail|required|unique:team|max:100',
                'logoUri' => 'required',
                'created_at' => 'nullable|date',
                'updated_at' => 'nullable|date'
            ]);
            $data = ['name' => $request->name, 'logoUri' => $request->logoUri, 'created_at' => \Carbon::now()];
            Log::info('Status :: store', ['message' => 'Team Created Successfully', 'params' => $data]);
            $teamModelObj = new Team();
            $teamModelObj->name = $request->name;
            $teamModelObj->logoUri = $request->logoUri;
            $teamModelObj->created_at = \Carbon::now();
            $teamModelObj->save();
        } catch (Exception $e) {
            Log::error('Error :', ['message' => $e->getMessage()]);
        }
        return redirect()->route('admin.team');
    }

    public function delete($id) {
        if (!empty($id)) {
            try {
                $teamObj = Team::find($id);
                if ($teamObj) {
                    Team::findOrFail($id)->delete();
                    Log::info("Status ::", ['message' => "$id deleted successfully."]);
                } else {
                    throw new Exception("Invalid data");
                }
            } catch (Exception $e) {
                Log::error('Delete failed', ['reason' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            }
        }
        return redirect()->route('admin.team');
    }

    public function edit($id) {
        if (!empty($id)) {
            try {
                $teamObj = Team::find($id);
                if ($teamObj) {
                    $data = $teamObj->toArray();
                    return view('team.update', ['team' => $data]);
                } else {
                    throw new Exception("Invalid data");
                }
            } catch (Exception $e) {
                Log::error('Delete failed', ['reason' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
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
                'name' => 'bail|required|max:100',
                'logoUri' => 'required',
                'created_at' => 'nullable|date',
                'updated_at' => 'nullable|date'
            ]);
            $data = ['id' => $id, 'name' => $request->name, 'logoUri' => $request->logoUri, 'created_at' => \Carbon::now()];
            $teamModelObj = Team::find($id);
            $teamModelObj->name = $request->name;
            $teamModelObj->logoUri = $request->logoUri;
            $teamModelObj->updated_at = \Carbon::now();
            $teamModelObj->save();
            $message = 'Team Updated Successfully !!';
            Log::info('Status :: store', ['message' => $message, 'params' => $data]);
        } catch (Exception $e) {
            $message = $e->getMessage();
            Log::error('Error :', ['message' => $e->getMessage()]);
        }
        return redirect()->route('admin.team')->with('message', $message);
    }

}
