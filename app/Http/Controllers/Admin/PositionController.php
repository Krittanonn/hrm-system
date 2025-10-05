<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;   

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::all();
        return view('admin.positions.index', compact('positions'));
    }

    public function create()
    {
        return view('admin.positions.create');
    }

    public function store(Request $request)
    {
        $name = trim($request->name);

        $request->validate([
            'name' => 'required|string|max:255|unique:positions,name',
        ]);

        Position::create(['name' => $name]);

        // Redirect ป้องกัน duplicate submission
        return redirect()->route('admin.positions.index')->with('success', 'เพิ่มตำแหน่งสำเร็จ');
    }


    public function edit($id)
    {
        $position = Position::findOrFail($id);
        return view('admin.positions.edit', compact('position'));
    }


    public function update(Request $request, $id)
    {

        $name = trim($request->name);

        $request->validate([
            'name' => 'required|string|max:255|unique:positions,name,' . $id,
        ]);

        $position = Position::findOrFail($id);
        $position->update(['name' => $name]);

        return redirect()->route('admin.positions.index')->with('success', 'อัปเดตตำแหน่งสำเร็จ');
    }

    public function destroy($id)
    {
        $position = Position::findOrFail($id);
        $position->delete();

        return redirect()->route('admin.positions.index')->with('success', 'ลบตำแหน่งสำเร็จ');
    }
}
