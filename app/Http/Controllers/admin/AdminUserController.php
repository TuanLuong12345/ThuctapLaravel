<?php

namespace App\Http\Controllers\admin;

use App\Exports\UsersExport;
use App\Exports\UsersExportSearch;
use App\Exports\UsersExportSearchSelected;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class AdminUserController extends Controller
{
    use  SoftDeletes;

    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $itemsPerPage = $request->input('itemsPerPage', 5);
        $users = DB::table('users')->select('*')
            ->where('deleted_at', null)
            ->paginate($itemsPerPage);
        $users->appends($request->all());
        if (!empty($page) && ($page > $users->lastPage())) {
            return redirect('/admin/users?page=1');
        }
        return view('admin.users.index', compact('users', 'itemsPerPage'));
    }

    public function create()
    {
        return view('admin.users.add');

    }

    public function store(UserRequest $request)
    {
        try {
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => $request->input('role')
            ]);
            toastr()->success('Thêm thông tin người dùng thành công');
            return redirect()->route('users.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Messege:' . $exception->getMessage() . '----Line:' . $exception->getLine());

        }

    }

    public function edit($id)
    {
        $users = User::findorFail($id);
        return view('admin.users.edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        try {
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => $request->input('role')
            ]);
            toastr()->success('Cập nhật thông tin người dùng thành công');
            return redirect()->route('users.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Messege:' . $exception->getMessage() . '----Line:' . $exception->getLine());

        }
    }

    public function delete($id)
    {
        User::findorFail($id)->delete();
        toastr()->success('Xóa thông tin người dùng thành công');
        return redirect()->route('users.index');
    }

    public function deleteAll(Request $request)
    {
        $userIds = explode(',', $request->ids);
        User::where('role', 'user')->whereIn('id', $userIds)->delete();
        return response()->json(['success' => "Products Deleted successfully."]);
    }

    public function restore($id)
    {
        User::withTrashed()->findOrFail($id)->restore();
        return back();
    }

    public function restoreAll()
    {
        User::onlyTrashed()->restore();
        return back();
    }

    public function search(Request $request)
    {
        $page = $request->input('page', 1);
        $itemsPerPage = $request->input('itemsPerPage', 5);
        $users = User::paginate($itemsPerPage);
        if (!empty($page) && ($page > $users->lastPage())) {

            return redirect('/admin/users?page=1');
        }
        $search = $request->input('search');
        $searchResults = User::where('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('phone', 'LIKE', "%{$search}%")
            ->orWhere('role', 'LIKE', "%{$search}%")
            ->paginate($itemsPerPage);
        $searchResults->appends($request->all());
        //Lấy ra tất cả dữ liệu sau khi search
        $searchResultsAll = User::where('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('phone', 'LIKE', "%{$search}%")
            ->orWhere('role', 'LIKE', "%{$search}%")
            ->get();
        $request->session()->put('export_data', $searchResultsAll);
        return view('search', compact('searchResults', 'search',
            'itemsPerPage', 'searchResultsAll'));
    }

    public function export()
    {
        return Excel::download(new UsersExport(), 'all_users.xlsx');
    }

    public function export_search(Request $request)
    {
        $searchResultsAll = $request->session()->get('export_data');
        return Excel::download(new UsersExportSearch($searchResultsAll), 'users_search.xlsx');
    }

    public function export_search_selected(Request $request)
    {
        $selectedIds = explode(',', $request->selected_ids);
        // Lấy dữ liệu từ CSDL dựa trên các ID đã chọn
        $selectedData = User::whereIn('id', $selectedIds)->get();
        // Gửi dữ liệu đến class xử lý Export (UsersExportSearchSelected)
        return Excel::download(new UsersExportSearchSelected($selectedData), 'selected_users.xlsx');
    }

    public function import(Request $request)
    {
        $import = new UsersImport;
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        if (!in_array($extension, ['xlsx', 'xls'])) {
            return back()->with('error', 'Chỉ chấp nhận file Excel (.xlsx, .xls).');
        }
        // Sử dụng thư viện Maatwebsite/Laravel-Excel để đọc tệp Excel
        $data = Excel::toArray(new UsersImport, $file);
        $errorRows = [];
        $validRows = [];
        foreach ($data[0] as $index => $row) {
            $validator = Validator::make($row, $import->rules(), $import->customValidationMessages());
            if ($validator->fails()) {
                $errorRows[] = [
                    'row' => $row,
                    'error_messages' => $validator->errors()->messages(),
                ];
            } else {
                $validRows[] = $row;
            }
        }
        $errorMessages = [];
        $i = 1;
        // Gán thông tin lỗi từ $errorRows vào $errorMessages
        foreach ($errorRows as $index => $error) {
            $i++;
            $rowDetails = $error['row'];
            $errors = $error['error_messages'];
            $errorMessages[] = [
                'row' => $rowDetails,
                'error_messages' => $errors,
                'i' => $i,
            ];
        }
        if (count($validRows) > 0) {
            foreach ($validRows as $row) {
                try {
                    $email = $row['email'];
                    $existingUser = User::where('email', $email)->first();
                    if ($existingUser) {
                        User::where('email', $email)->update([
                            'name' => $row['name'],
                            'password' => Hash::make($row['password']),
                            'phone' => $row['phone'],
                            'role' => $row['role'],
                        ]);
                    } else {
                        // Nếu không tìm thấy người dùng, tạo mới bản ghi
                        User::create([
                            'email' => $email,
                            'name' => $row['name'],
                            'password' => Hash::make($row['password']),
                            'phone' => $row['phone'],
                            'role' => $row['role'],
                        ]);
                    }
                } catch (\Exception $exception) {
                    $errorMessages[] = [
                        'row' => $row,
                        'error_messages' => $exception->getMessage(),
                    ];
                }
            }
        }
        return back()->with('errorMessages', $errorMessages);
    }
}
