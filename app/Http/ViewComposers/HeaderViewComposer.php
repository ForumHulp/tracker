<?php

namespace App\Http\ViewComposers;

use App\Issue;
use Illuminate\View\View;

class HeaderViewComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $statistics = new \stdClass;
		$statistics->total = Issue::all()->where('parent_id', null)->count();
        $statistics->types = Issue::selectRaw('COUNT("id") AS total, type_id')->where('parent_id', null)->groupBy('type_id')->orderBy('type_id')->get();
        $statistics->status = Issue::selectRaw('COUNT("id") AS total, status_id')->where('parent_id', null)->groupBy('status_id')->orderBy('status_id')->get();

        $view->with('issue_count', $statistics);
    }
}