<?php

namespace App\Http\Controllers;

use App\Helpers\Parser;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BookmarkExportCollection;
use App\Http\Requests\Bookmark\CreateBookmarkRequest;
use App\Http\Requests\Bookmark\DeleteBookmarkRequest;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookmarks = Bookmark::sortable(['created_at' => 'desc'])->paginate(20);

        return view('bookmark.index', compact('bookmarks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('bookmark.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBookmarkRequest $request)
    {

        $bookmark = new Bookmark;
        $parser = new Parser($request->url);

        $bookmark->url = $parser->getUrl();
        $bookmark->title = $parser->getData('title');
        $bookmark->description = $parser->getData('description');
        $bookmark->keywords = $parser->getData('keywords');
        $bookmark->favicon = $parser->getData('favicon');

        if(!empty($request->password))
            $bookmark->password = Hash::make($request->password);

        $bookmark->save();

        return redirect(route('bookmark.show', $bookmark))->withMessage('Закладка добавлена');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bookmark $bookmark)
    {
        return view('bookmark.show', compact('bookmark'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteBookmarkRequest $request, Bookmark $bookmark)
    {
        $bookmark->delete();

        request()->session()->flash('message', 'Закладка удалена');

        return response()->json(['redirect' => route('bookmark.index'), 200]);
    }

    /**
     * Export bookmarks to excel
     *
     * @return void
     */
    public function export()
    {
        $bookmarks = Bookmark::orderBy('created_at', 'asc');

        $excelName = ['bookmarks'];

        return Excel::download(new BookmarkExportCollection($bookmarks), implode("-", $excelName).'-'.date('Ymd-His').'.xlsx');
    }
}
