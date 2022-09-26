<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDF;
class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.index');
    }

    public function listData()
    {
        $member = Member::orderBy('id_member', 'desc')->get();
        $data = array();

        foreach ($member as $key => $list) {
            $no = $key + 1;
            $row = array();
            $row[] = "<input type='checkbox' name='id[]' value='". $list->id_member ."'>";
            $row[] = $no;
            $row[] = $list->kode_member;
            $row[] = $list->nama;
            $row[] = $list->alamat;
            $row[] = $list->telpon;
            $row[] = '
                <div class="btn-group w-100">
                    <a onclick="editForm('. $list->id_member .')" class="btn btn-info btn-sm btn-icon" aria-label="Button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                    </a>
                    <a onclick="deleteData('. $list->id_member .')" class="btn btn-danger btn-sm btn-icon" aria-label="Button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                    </a>
                </div>
            ';
            $data[] = $row;
        }

        $output = array("data" => $data);
        return response()->json($output);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'telpon' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $jml = Member::where('kode_member', '='. $request['kode'])->count();

        if ($jml < 1) {
            $member = new Member;
            $member->kode_member = $request['kode'];
            $member->nama = $request['nama'];
            $member->alamat = $request['alamat'];
            $member->telpon = $request['telpon'];
            $member->save();
            echo json_encode(array('msg' => 'success'));
        } else {
            echo json_encode(array('msg' => 'error'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::find($id);
        echo json_encode($member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'telpon' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $member = Member::find($id);
        $member->nama = $request['nama'];
        $member->alamat = $request['alamat'];
        $member->telpon = $request['telpon'];
        $member->update();
        echo json_encode(array('msg' => 'success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();
    }

    public function printCard(Request $request)
    {
        $dataMember = array();
        foreach ($request['id'] as $id) {
            $member = Member::find($id);
            $dataMember[] = $member;
        }

        $pdf = \PDF::loadView('member.card', compact('dataMember'));
        $pdf->setPaper(array(0, 0, 566.93, 850.39), 'potrait');
        return $pdf->stream();
    }
}
