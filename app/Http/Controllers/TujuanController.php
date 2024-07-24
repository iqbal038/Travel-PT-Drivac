<?php

namespace App\Http\Controllers;

use App\Models\Tujuan;
use Illuminate\Http\Request;
use TheSeer\Tokenizer\Exception;

class TujuanController extends Controller
{

    public function index()
    {
        $tujuan = Tujuan::all();
        return view('pages.tujuan', compact('tujuan'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'tujuan' => 'required|unique:tujuan'
            ]);

            Tujuan::create($request->all());

            return redirect()->to('tujuan')->with('success', 'Data berhasil ditambah');
            
        } catch(Exception $e) {
            return redirect()->to('tujuan')->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, Tujuan $tujuan, $id)
    {
        $cek = Tujuan::findOrFail($id);
        if($cek)
        {
            try {
                $this->validate($request, [
                    'tujuan' => 'unique:tujuan'.',id,'.$tujuan->id,
                ]);
                
                Tujuan::where('id', $id)->update([
                    'tujuan' => $request->tujuan,
                    'harga' => $request->harga,
                ]);

                return redirect()->to('tujuan')->with('success', 'Data berhasil diubah');
            } catch(Exception $e)
            {
                throw new Exception($e->getMessage());
            }
        } else {
            return redirect()->to('tujuan')->with('error', 'Data tidak ditemukan');
        }
    }

    public function destroy($id)
    {
        $cek = Tujuan::findOrFail($id);
        if($cek)
        {
            try {
                Tujuan::where('id', $id)->delete();

                return redirect()->to('tujuan')->with('success', 'Data berhasil dihapus');
            } catch(Exception $e)
            {
                throw new Exception($e->getMessage());
            }
        } else {
            return redirect()->to('tujuan')->with('error', 'Data tidak ditemukan');
        }
    }
}
