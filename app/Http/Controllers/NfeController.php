<?php

namespace App\Http\Controllers;

use App\Models\Nfe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class NfeController extends Controller
{
    public function show(Request $request) {
        return true;
        // $nfe = Nfe::findById(1);
        // $response = Gate::inspect('isNfeOwner', $nfe);

        // if ($response->denied()) {
        //     return $response->message();
        // }
        // return true;
    }

    public function store(Request $request) {
        return true;
    }

    public function update(Request $request) {
        return true;
    }

    public function destroy(Request $request) {
        return true;
    }

}
