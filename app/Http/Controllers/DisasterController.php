<?php

namespace App\Http\Controllers;

use App\Models\Disaster;
use Illuminate\Http\Request;

class DisasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $disasters = Disaster::where('status', 'approved')->get();
        return view('admin.disaster.index', [
            'title' => 'Manajemen Bencana Alam | Sistem Informasi Bencana Alam Kota Depok',
            'disasters' => $disasters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('front.create_bencana', [
            'title' => 'Form Pelaporan Bencana Alam di Kota Depok'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Disaster::create([
            'nama' => $request->nama,
            'tgl' => $request->tgl,
            'lat' => $request->lat,
            'long' => $request->long,
        ]);

        // Return to home with success message
        return redirect('/')->with('success', 'Pelaporan bencana alam berhasil');
    }

    public function approve(Disaster $disaster)
    {
        $disaster->update([
            'status' => 'approved'
        ]);

        return redirect('/dashboard')->with('success', 'Bencana alam berhasil diapprove');
    }

    public function reject(Disaster $disaster)
    {
        $disaster->update([
            'status' => 'rejected'
        ]);

        return redirect('/dashboard')->with('success', 'Bencana alam berhasil ditolak');
    }

    /**
     * Display the specified resource.
     */
    public function show(Disaster $disaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Disaster $disaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Disaster $disaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disaster $disaster)
    {
        // Delete the disaster
        $disaster->delete();

        // Return to home with success message
        return redirect('/disaster')->with('success', 'Bencana alam berhasil dihapus');
    }
}
