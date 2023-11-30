<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Models\NewsEn;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class NEWSUserController extends Controller
{
    use SoftDeletes;

    public function index()
    {
        $locale = config('app.locale');
        $username = Auth::user()->name;
        $userId = auth()->id();
        $User_news = News::where('user_id', $userId)->paginate(5);
        return view('user.news.index', compact('User_news', 'username',
            'locale'));
    }

    public function view($id)
    {
        $locale = config('app.locale');
        $newsUserView = News::findorFail($id);
        $newsUserViewEn = NewsEn::where('new_id', $id)->first();
        if (auth()->id() != $newsUserView->user_id) {
            return back()->with('error', 'Bạn chỉ xem bài viết của chính mình');
        }
        return view('user.news.view', compact('newsUserView',
            'newsUserViewEn', 'locale'));
    }

    public function create()
    {
        $username = Auth::user()->name;
        return view('user.news.add', compact('username'));
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

        $successMessage = '';

        if ($status === 1) {
            $successMessage = 'Tạo bài viết thành công.';
        } else {
            $successMessage = 'Tạo bài viết thành công, chờ admin phê duyệt.';
        }

        return redirect()->route('user.news.index')->with('success', $successMessage);
    }

    //Thêm bài viết tiếng Anh của user


    public function store_en($id, Request $request)
    {
        $newsUser = News::where('id', $id)->first();
        $imageName = time() . '.' . $request->thumbnail->extension();
        $request->thumbnail->storeAs('public/images', $imageName);
        NewsEn::create([
            'user_id' => $newsUser->user_id,
            'new_id' => $id,
            'thumbnail' => $imageName,
            'public_at' => $request->input('public_at'),
            'title' => $request->input('title_en'),
            'content' => $request->input('content_en'),
            'status' => $newsUser->status,
            'banner' => $newsUser->banner,
        ]);
        toastr()->success('Thêm  bài viết Tiếng Anh thành công');
        return redirect()->route('user.news.index');
    }

    public function edit_select($id)
    {
        return view('user.news.select_edit', compact('id'));
    }

    //End
    public function edit(Request $request, $id)
    {
        $locale = $request->input('locale', 'en');
        $newsUserEdit = News::findorFail($id);
        $newsUserEditEn = NewsEn::where('new_id', $id)->first();
        if (auth()->id() != $newsUserEdit->user_id) {
            return back()->with('error', 'Bạn chỉ sửa bài viết của chính mình');
        }
        $newsPublicAt = date('Y-m-d\TH:i', strtotime($newsUserEdit->public_at));
        return view('user.news.edit', compact('newsUserEdit',
            'newsUserEditEn', 'newsPublicAt', 'locale'));
    }

    public function update(NewsRequest $request, $id)
    {
        $newsUser = News::where('id', $id)->first();
        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('storage/images/', $filename);
        } else {
            $filename = $newsUser->thumbnail;
        }
        News::where('id', $id)->update([
            'title' => $request->title_vi,
            'thumbnail' => $filename,
            'content' => $request->input('content_vi'),
            'public_at' => $request->input('public_at'),
            'updated_at' => now(),
        ]);
        toastr()->success('Cập nhật thông tin bài viết Tiếng Việt thành công');
        return redirect()->route('user.news.index');
    }

    public function update_en(Request $request, NewsEn $news, $id)
    {
        $newsUserEn = NewsEn::where('id', $id)->first();
        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('storage/images/', $filename);
        } else {
            $filename = $newsUserEn->thumbnail;
        }
        NewsEn::where('id', $id)->update([
            'title' => $request->input('title_en'),
            'content' => $request->input('content_en'),
            'thumbnail' => $filename,
            'public_at' => $request->input('public_at'),
            'updated_at' => now(),
        ]);
        toastr()->success('Cập nhật thông tin bài viết Tiếng Anh thành công');
        return redirect()->route('user.news.index');
    }

    public function delete($id)
    {
        if (auth()->id() != News::findOrFail($id)->user_id) {
            return back()->with('error', 'Bạn chỉ được xóa bài viết của chính mình');
        }
        $newsEnToDelete = NewsEn::where('new_id', $id)->first();
        if ($newsEnToDelete) {
            NewsEn::where('new_id', $id)->delete();
            News::find($id)->delete();
        } else {
            News::find($id)->delete();
        }
            toastr()->success('Xóa thông tin bài viết thành công');
            return redirect()->route('user.news.index');

    }
}

