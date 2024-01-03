<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNfeRequest;
use App\Models\Nfe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class NfeController extends Controller
{
    /**
     * Show NFE filter by id
     * @param Request $request
     * @return Response
     */
    public function show(Request $request) {
        try {
            $nfe = Nfe::find($request->route('nfe'));
            $response = Gate::inspect('isNfeOwner', $nfe);

            if ($response->denied()) {
                return response()->json([
                    'message' => 'Permission error',
                    'error' => $response->message()
                ]);
            }
            return response()->json([
                'message' => '',
                'nfe' => $nfe
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Index a list of NFE filter by user id
     * @param Request $request
     * @return Response
     */
    public function index(Request $request) {
        try {
            $nfes = Nfe::where('user_id', auth()->user()->id)->get();

            return response()->json([
                'message' => '',
                'nfe' => $nfes
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create a new NFE
     * @param StoreNfeRequest $request
     * @return Response
     */
    public function store(StoreNfeRequest $request) {
        try {
            $validated = $request->validated();
            $validated['user_id'] = auth()->user()->id;

            $nfe = Nfe::create($validated);

            return response()->json([
                'message' => 'NFE created',
                'nfe' => $nfe
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update a NFE by id
     * @param StoreNfeRequest $request
     * @return Response
     */
    public function update(StoreNfeRequest $request) {
        try {
            $validated = $request->validated();
            $validated['user_id'] = auth()->user()->id;

            $nfe = Nfe::findOrFail($request->route('nfe'));
            $response = Gate::inspect('isNfeOwner', $nfe);
            if ($response->denied()) {
                return response()->json([
                    'message' => 'Permission error',
                    'error' => $response->message()
                ]);
            }
            $nfe->update($validated);

            return response()->json([
                'message' => 'NFE updated',
                'nfe' => $nfe
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a NFE by id
     * @param Request $request
     * @return Response
     */
    public function destroy(Request $request) {
        try {
            $nfe = Nfe::findOrFail($request->route('nfe'));
            $response = Gate::inspect('isNfeOwner', $nfe);
            if ($response->denied()) {
                return response()->json([
                    'message' => 'Permission error',
                    'error' => $response->message()
                ]);
            }
            $nfe->delete();

            return response()->json([
                'message' => 'NFE destroyed',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Exception error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
