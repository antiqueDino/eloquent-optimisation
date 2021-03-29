<?php

namespace App\Http\Controllers;

use App\Features;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    public function index()
    {
        // $statuses = (object) [];
        // $statuses->requested = Features::where('status','Requested')->count();
        // $statuses->planned = Features::where('status','Planned')->count();
        // $statuses->completed = Features::where('status','Completed')->count();

        $statuses = Features::toBase()
            ->selectRaw("count(case when status = 'Requested' then 1 end) as requested")
            ->selectRaw("count(case when status = 'Planned' then 1 end) as planned")
            ->selectRaw("count(case when status = 'Completed' then 1 end) as completed")
            ->first();

        $features = Features::query()
            ->withCount('comments')
            ->paginate();

        return view('features', [
                'statuses' => $statuses,
                'features' => $features
        ]);
    }
}
