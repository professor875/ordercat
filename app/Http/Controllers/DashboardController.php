<?php

namespace App\Http\Controllers;

use App\Http\Resources\BuildingResource;
use App\Http\Resources\ItemResource;
use App\Http\Resources\KitchenResource;
use App\Models\Building;
use App\Models\Item;
use App\Models\Kitchen;
use App\Models\Stage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = [
            'building' => Building::count(),
            'kitchen' => Kitchen::count(),
            'item' => Item::count(),
            'stage' => Stage::count(),
        ];

        return inertia('Dashboard/Index', compact(['counts']));
    }

    public function stagesLineChart($period = 'daily')
    {
        $chart = [];

        if ($period == 'daily') {
            $data = DB::table('stages')
                ->select(
                    DB::raw('DATE(created_at) as date'),
                    DB::raw('count(*) as count')
                )
                ->where('created_at', '>=', now()->subDays(7))
                ->groupBy('date')
                ->orderBy('date', 'ASC')
                ->get();

            foreach ($data as $item) {
                $chart['data'][] = $item->count;
                $chart['labels'][] = Carbon::make($item->date)->dayName;
            }
        }

        if ($period == 'weekly') {
            $data = DB::table('stages')
                ->select(
                    DB::raw('WEEK(created_at) as week'),
                    DB::raw('count(*) as count')
                )
                ->where('created_at', '>=', now()->subWeeks(7))
                ->groupBy('week')
                ->orderBy('week', 'ASC')
                ->get();

            foreach ($data as $item) {
                $chart['data'][] = $item->count;
                $chart['labels'][] = 'Week ' . $item->week;
            }
        }

        if ($period == 'monthly') {
            $data = DB::table('stages')
                ->select(
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('count(*) as count')
                )
                ->where('created_at', '>=', now()->subMonths(6)) // Adjusted to 6 months for monthly data
                ->groupBy('month')
                ->orderBy('month', 'ASC')
                ->get();

            foreach ($data as $item) {
                $chart['data'][] = $item->count;
                $chart['labels'][] = date('F', mktime(0, 0, 0, $item->month, 1)) . ' ' . date('Y', strtotime(now()));
            }
        }


        return $this->sendResponse(compact('chart'));
    }

    public function stagesPieChart($period = 'daily')
    {
        $chart = [
            'series' => [],
            'labels' => config('constants.stageStatuses')
        ];

        foreach (config('constants.stageStatuses') as $status) {
            $chart['series'][] = Stage::where('status', $status)->count();
        }

        $chart['total'] = Stage::count();

        return $this->sendResponse(compact('chart'));
    }

    public function bestBuildings()
    {
        $buildings = BuildingResource::collection(
            Building::withCount('stages')
                ->limit(10)
                ->having('stages_count', '>', 0)
                ->orderByDesc('stages_count')
                ->get()
        );

        return $this->sendResponse(compact('buildings'));
    }

    public function bestKitchens()
    {
        $kitchens = KitchenResource::collection(
            Kitchen::withCount('stages')
                ->limit(10)
                ->having('stages_count', '>', 0)
                ->orderByDesc('stages_count')
                ->get()
        );

        return $this->sendResponse(compact('kitchens'));
    }

    public function bestItems()
    {
        $items = ItemResource::collection(
            Item::withCount('stages')
                ->limit(10)
                ->having('stages_count', '>', 0)
                ->orderByDesc('stages_count')
                ->get()
        );

        return $this->sendResponse(compact('items'));
    }
}
