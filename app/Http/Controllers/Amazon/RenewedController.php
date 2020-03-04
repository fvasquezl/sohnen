<?php

namespace App\Http\Controllers\Amazon;

use App\ASM;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class RenewedController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ASM $asm)
    {
        $this->validate($request, [
            'IsRenewed' => ['required', Rule::in(['true', 'false'])],
        ]);

        $asm->update(['IsRenewed' => $request->IsRenewed]);

        return response()->json(['success' => true, 'msg' => 'The information has been updated']);
    }
}
