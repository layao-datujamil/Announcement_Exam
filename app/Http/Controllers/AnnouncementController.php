<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Throwable;

class AnnouncementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('announcement.index');
    }

    public function GetAllAnnouncements(){
        return datatables()->of(Announcement::all())
        ->addColumn('action',function($data){
            $button = '<div class="btn-group btn-group-sm">';
            $button .= '<a href="/announcements/' . $data->id . '/edit" class="btn btn-secondary"><i class="fa fa-edit"></i></a>';
            $button .= '<button class="btn btn-danger" onclick="deleteAnnouncement(' . $data->id . ')"><i class="fa fa-trash"></i></button>';
            $button .= '</div>';
            return $button;
        })
        ->addColumn('stat',function($data){
            if ($data->status==true){
                $stat= '<span class="badge badge-success">Active</span>';
            }else{
                $stat = '<span class="badge badge-danger">Inactive</span>';
            }
            return $stat;
        })
        ->rawColumns(['action','stat'])
        ->make(true);
    //}
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('announcement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnnouncementRequest $request)
    {
        $data = $request->validated();
        $status = false;
        if (Carbon::parse($data['startdate'])->isSameDay(today())){
            $status = true;
        }
        try {
            Announcement::create([
                "title" => $data['title'],
                "content" => $data['content'],
                "startdate" => Carbon::parse($data['startdate'])->format("Y-m-d"),
                "enddate" => Carbon::parse($data['enddate'])->format("Y-m-d"),
                "status" => $status,
            ]);
        }catch(Throwable $exception){
            return back()->with('error',$exception->getMessage())->withInput($data);
        }
        return view('announcement.index')->with('success','Announcement successfully saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        return view ('announcement.edit',compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(AnnouncementRequest $request, Announcement $announcement)
    {
        $data = $request->validated();
        $status = false;
        if (Carbon::parse($data['startdate'])->isSameDay(today())){
            $status = true;
        }
        try {
            $announcement->update([
                'title' => $data['title'],
                'content' => $data['content'],
                "startdate" => Carbon::parse($data['startdate'])->format("Y-m-d"),
                "enddate" => Carbon::parse($data['enddate'])->format("Y-m-d"),
                "status" => $status,
            ]);
        }catch(Throwable $exception){
            return back()->with('error',$exception->getMessage())->withInput($data);
        }
                
        return redirect('/announcements')->with('success','Announcement successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return response()->json(['success'=> 'Announcement has been deleted.']);
    }
}
