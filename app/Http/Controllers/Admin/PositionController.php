<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;   

class PositionController extends Controller
{
    // แสดงรายการตำแหน่งทั้งหมด
    public function index()
    {
        $positions = Position::all();
        return view('admin.positions.index', compact('positions'));
    }

    // ฟอร์มเพิ่มตำแหน่ง
    public function create()
    {
        return view('admin.positions.create');
    }

    // บันทึกข้อมูลตำแหน่งใหม่
    public function store(Request $request)
    {
        // ตัดช่องว่างรอบ ๆ
        $name = trim($request->name);

        // Validate
        $request->validate([
            'name' => 'required|string|max:255|unique:positions,name',
        ]);

        // สร้างตำแหน่ง
        Position::create(['name' => $name]);

        // Redirect ป้องกัน duplicate submission
        return redirect()->route('admin.positions.index')->with('success', 'เพิ่มตำแหน่งสำเร็จ');
    }

    // ฟอร์มแก้ไขตำแหน่ง
    public function edit($id)
    {
        $position = Position::findOrFail($id);
        return view('admin.positions.edit', compact('position'));
    }

    // อัปเดตข้อมูลตำแหน่ง
    public function update(Request $request, $id)
    {
        // ตัดช่องว่างรอบ ๆ
        $name = trim($request->name);

        // Validate
        $request->validate([
            'name' => 'required|string|max:255|unique:positions,name,' . $id,
        ]);

        // อัปเดต
        $position = Position::findOrFail($id);
        $position->update(['name' => $name]);

        return redirect()->route('admin.positions.index')->with('success', 'อัปเดตตำแหน่งสำเร็จ');
    }
}