<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Models\User;
use App\Models\NewsEn;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class NEWSAdminController extends Controller
{
    use SoftDeletes;

    public function index()
    {
        $locale = config('app.locale');
        $news = News::paginate(5);
        return view('admin.news.index', compact('news', 'locale'));
    }

    public function view($id)
    {
        $locale = config('app.locale');
        $newsView = News::findOrFail($id);

        $newsViewEn = NewsEn::where('new_id', $id)->first();
        return view('admin.news.view', compact('newsView',
            'newsViewEn', 'locale'));
    }

    public function create()
    {
        return view('admin.news.add');
    }

    public function store(NewsRequest $request, User $user)
    {
        $status = auth()->user()->role === 'admin' ? 1 : 0;
        $imageName = time() . '.' . $request->thumbnail->extension();
        $request->thumbnail->storeAs('public/images', $imageName);
        News::create([
            'title' => $request->title_vi,
            'user_id' => auth()->id(),
            'content' => $request->input('content_vi'),
            'thumbnail' => $imageName,
            'public_at' => $request->input('public_at'),
            'status' => $status,
        ]);
        toastr()->success('Thêm  bài viết Tiếng Việt thành công');
        return redirect()->route('news.index');
    }

    //Thêm bài viết phiên bản Tiếng Anh

    public function store_en($id, Request $request)
    {
        $news = News::where('id', $id)->first();
        $imageName = time() . '.' . $request->thumbnail->extension();
        $request->thumbnail->storeAs('public/images', $imageName);
        NewsEn::where('new_id', $id)->Create([
            'user_id' => $news->user_id,
            'new_id' => $id,
            'thumbnail' => $imageName,
            'public_at' =>  $request->input('public_at'),
            'title' => $request->input('title_en'),
            'content' => $request->input('content_en'),
            'status' => $news->status,
            'banner' => $news->banner,
        ]);
        toastr()->success('Thêm  bài viết Tiếng Anh thành công');
        return redirect()->route('news.index');
    }

    //End
    public function edit_select($id)
    {
        return view('admin.news.select_edit',compact('id'));
    }
    public function edit( $id,Request $request)
    {
        $locale = $request->input('locale', 'en');
        $newsEdit = News::findorFail($id);
        $newsEditEn = NewsEn::where('new_id', $id)->first();
        $newsPublicAt = date('Y-m-d\TH:i', strtotime($newsEdit->public_at));
        return view('admin.news.edit', compact('newsEdit',
            'newsPublicAt', 'newsEditEn', 'locale','id'));
    }

    public function update(Request $request, $id)
    {
        $news = News::where('id', $id)->first();
        if ( $request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('storage/images/', $filename);
        } else {
            $filename = $news->thumbnail;
        }
        News::where('id', $id)->update([
            'title' => $request->title_vi,
            'thumbnail' => $filename,
            'content' => $request->input('content_vi'),
            'public_at' => $request->input('public_at'),
            'updated_at' => now(),
        ]);
        toastr()->success('Cập nhật thông tin bài viết Tiếng Việt thành công');
        return redirect()->route('news.index');
    }

    public function update_en(Request $request, NewsEn $news, $id)
    {
        $newsEn = NewsEn::where('id', $id)->first();
        if ( $request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('storage/images/', $filename);
        } else {
            $filename = $newsEn->thumbnail;
        }
        NewsEn::where('id', $id)->update([
            'title' => $request->input('title_en'),
            'content' => $request->input('content_en'),
            'thumbnail' => $filename,
            'public_at' => $request->input('public_at'),
            'updated_at' => now(),
        ]);
        toastr()->success('Cập nhật thông tin bài viết Tiếng Anh thành công');
        return redirect()->route('news.index');
    }

    public function delete($id)
    {
        $newEn = NewsEn::where('new_id',$id)->first();
        if ($newEn) {
            NewsEn::where('new_id', $id)->delete();
            News::find($id)->delete();
        } else {
            News::find($id)->delete();
        }
        toastr()->success('Xóa thông tin bài viết thành công');
        return redirect()->route('news.index');

    }

    public function status($id)
    {
        $news = News::findorFail($id);
        $news->status = 1;
        $news->save();

        $newsEn =NewsEn::where('new_id',$id)->first();
        if ($newsEn == null){
            return redirect()->route('news.index')->with('Success', 'Phê duyệt bài thành công');
        }
        $newsEn->status = 1;
        $newsEn->save();
        return redirect()->route('news.index')->with('Success', 'Phê duyệt bài thành công');
    }
}
