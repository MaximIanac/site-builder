<?php

namespace App\Http\Controllers\ControlPanel\Content\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maximianac\SiteBuilder\Data\Content\PanelData;
use Maximianac\SiteBuilder\Models\Panel;
use Maximianac\SiteBuilder\Utility\Enums\EntryType;

class PanelController extends Controller
{
    public function add(Request $request)
    {
        $data = $request->input();
        $panel = Panel::find($data['panel']['id']);
        $content = $panel->content;

        $fields = collect($data['panel']['fields'])->map(function ($item) {
            $item['translations'] = [];
            return $item;
        });

        /** @var Panel $newPanel */
        $newPanel = $content->panels()->create(['order' => $data['new_order']]);

        $fields->each(fn($field) => $newPanel->fields()->create([
            'key' => $field['key'],
            'type' => EntryType::from($field['type']),
        ]));

        $html = view('components.panels.item', [
            'panel' => PanelData::from($newPanel),
            'dataName' => "content[{$data['loop_index']}][data][{$data['new_order']}]"
        ])->render();

        return response()->json([
            'id' => $newPanel->id,
            'html' => $html,
        ]);
    }

    public function delete(Request $request)
    {
        $panel = Panel::findOrFail($request->input('panel_id'));

        $panel->delete();
    }
}
