<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    use SoftDeletes;
    public function type($type)
    {
        $infoOfType = Info::where('type', $type)->first();
        return view ('home.info.index',compact('infoOfType'));
    }
    public function index()
    {
        $info_Admin = Info::paginate(3);
        return view('admin.info.index',compact('info_Admin'));
    }
    public function view($id)
    {
        $InfoViews = Info::findOrFail($id);
        return view('admin.info.view',compact('InfoViews'));
    }
    public function create()
    {
        return view('admin.info.add');
    }
    public function store(Request $request)
    {
        $imageName = time() . '.' . $request->thumbnail->extension();
        $request->thumbnail->storeAs('public/images', $imageName);

        Info::create([
            'title' => $request->title,
            'content' => $request->input('content'),
            'thumbnail' => $imageName,
            'type' => $request->type
        ]);
        toastr()->success('Thêm thông tin Info thành công');
        return redirect()->route('info.index');
    }
    public function edit( $id)
    {
        $InfoEdit = Info::findorFail($id);
        return view('admin.info.edit', compact('InfoEdit'));
    }
    public function update(Request $request, $id)
    {
        $news = Info::where('id', $id)->first();
        if ( $request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('storage/images/', $filename);
        } else {
            $filename = $news->thumbnail;
        }
        Info::where('id', $id)->update([
            'title' => $request->title,
            'content' => $request->input('content'),
            'thumbnail' => $filename,
            'type' => $request->type,
            'updated_at' => now(),
        ]);
        toastr()->success('Cập nhật thông tin Info thành công');
        return redirect()->route('info.index');
    }
    public function delete( $id)
    {
        Info::findorFail($id)->delete();
        toastr()->success('Xóa thông tin Info thành công');
        return redirect()->route('info.index');
    }
}
