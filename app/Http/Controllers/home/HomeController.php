<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\News;
use App\Models\NewsEn;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome()
    {
        return redirect()->route('home.index');
    }
    public function index()
    {
        $current_datetime = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
        $locale = config('app.locale');
        $news_banner = News::where('banner', 1)
            ->where('public_at', '<=', $current_datetime)
            ->where('status', 1)
            ->orderBy('public_at', 'desc')
            ->get();

        $news_banner_en = NewsEn::where('banner', 1)
            ->where('public_at', '<=', $current_datetime)
            ->where('status', 1)
            ->orderBy('public_at', 'desc')
            ->get();
        $latest_news = News::where('banner', 0)
            ->where('public_at', '<=', $current_datetime)
            ->where('status', 1)
            ->orderBy('public_at', 'DESC')
            ->take(3)
            ->get();
        $latest_news_en = NewsEn::where('banner', 0)
            ->where('public_at', '<=', $current_datetime)
            ->where('status', 1)
            ->orderBy('public_at', 'DESC')
            ->take(3)
            ->get();
        return view('home.home', compact('news_banner',
            'latest_news', 'latest_news_en', 'locale', 'news_banner_en'));
    }

    public function news_all()
    {
        $locale = config('app.locale');
        $current_datetime = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
        $news = News::where('banner', 0)
            ->where('public_at', '<=', $current_datetime)
            ->where('status', 1)
            ->get();
        $news_En = NewsEn::where('banner', 0)
            ->where('public_at', '<=', $current_datetime)
            ->where('status', 1)
            ->get();
        return view('home.news.new_all', compact('news', 'news_En', 'locale'));
    }

    public function news_one($locale, $id)
    {
        if ($locale === 'vi') {
            $news_one = News::find($id);
            $news_one_en = NewsEn::where('new_id', $id)->first();
        } elseif ($locale === 'en') {
            $news_one_en = NewsEn::findorFail($id);
            $news_one = News::where('id', $news_one_en->new_id)->first();
        }
        if ($news_one == null) {
            abort(Response::HTTP_NOT_FOUND);
        }
        $locale_default = config('app.locale');
        return view('home.news.new_one', compact('news_one',
            'news_one_en', 'locale_default'));
    }

    public function contact()
    {
        return view('home.contact.index');
    }

    public function contact_store(Request $request)
    {
        $recaptcha = $request->input('g-recaptcha-response');
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $dataRecaptcha = [
            'secret' => '6LfqYw4pAAAAAKvaADBy65QeTdJHM94mOXm3oWZc',
            'response' => $recaptcha,
        ];
        $optionsRecaptcha = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($dataRecaptcha),
            ],
        ];
        $contextRecaptcha = stream_context_create($optionsRecaptcha);
        $resultRecaptcha = file_get_contents($url, false, $contextRecaptcha);
        $resultJson = json_decode($resultRecaptcha);
        if ($resultJson->success) {
            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'title' => $request->input('title'),
                'content' => $request->input('content'),
            ];
            $contact = Contact::create($data);
            return back()->with('success', 'Thông tin liên hệ đã được gửi thành công!');
        } else {
            return back()->with('error', 'Xác minh reCAPTCHA không thành công. Vui lòng thử lại.');
        }
    }

    public function contact_admin()
    {
        $contacts = Contact::orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function contact_delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('admin.contact_admin')->with('success', 'Liên hệ đã được xóa thành công!');
    }

    public function contact_view($id)
    {
        $contact = Contact::findorFail($id);
        $contact->update(['status' => 1]);
        return view('admin.contacts.view', compact('contact'));
    }

    public function calender()
    {
        $locale = config('app.locale');
        if ($locale === 'vi')
            $events = News::whereNotNull('public_at')
                ->where('status', 1)
                ->get(['title', 'public_at'])
                ->groupBy(function ($date) {
                    return Carbon::parse($date->public_at)->format('Y-m-d');
                })
                ->map(function ($day) {
                    return count($day);
                });
        else {
            $events = NewsEn::whereNotNull('public_at')
                ->where('status', 1)
                ->get(['title', 'public_at'])
                ->groupBy(function ($date) {
                    return Carbon::parse($date->public_at)->format('Y-m-d');
                })
                ->map(function ($day) {
                    return count($day);
                });
        }
        return view('home.calender.index', compact('events', 'locale'));
    }

    public function news_day(Request $request)
    {
        $locale = config('app.locale');
        $dates = $request->input('date');
        try {
            Carbon::parse($dates);
        }
        catch (\Exception $e)
        {
            abort(404);
        }
        $date = Carbon::parse($dates)->format('d/m/Y');
        $now = Carbon::now();
        $news = News::whereDate('public_at', $dates)
            ->where('status', 1)
            ->where('deleted_at', null)
            ->where('public_at', '<=', $now)
            ->get();
        $news_En = NewsEn::whereDate('public_at', $dates)
            ->where('status', 1)
            ->where('deleted_at', null)
            ->where('public_at', '<=', $now)
            ->get();
        return view('home.calender.news_day', compact('news',
            'news_En', 'date', 'locale'));
    }

    public function switchLanguage($locale)
    {
        $supportedLocales = config('app.locale_all');
        if (!in_array($locale, $supportedLocales)) {
            abort(404);
        }
        app()->setLocale($locale);
        Session::put('locale', $locale);
        return redirect()->back();
    }
}
