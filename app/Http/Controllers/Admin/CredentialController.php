<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCredentialRequest;
use App\Http\Requests\StoreCredentialRequest;
use App\Http\Requests\UpdateCredentialRequest;
use App\Models\Credential;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Illuminate\Support\Facades\Hash;

class CredentialController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('credential_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $credentials = Credential::all();

        return view('admin.credentials.index', compact('credentials'));
    }

    public function create()
    {
        abort_if(Gate::denies('credential_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.credentials.create');
    }

    public function store(StoreCredentialRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $credential = Credential::create($data);

        return redirect()->route('admin.credentials.index');
    }

    public function edit(Credential $credential)
    {
        abort_if(Gate::denies('credential_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.credentials.edit', compact('credential'));
    }

    public function update(UpdateCredentialRequest $request, Credential $credential)
    {
        $credential->update($request->all());

        return redirect()->route('admin.credentials.index');
    }

    public function show(Credential $credential)
    {
        abort_if(Gate::denies('credential_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.credentials.show', compact('credential'));
    }

    public function destroy(Credential $credential)
    {
        abort_if(Gate::denies('credential_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $credential->delete();

        return back();
    }

    public function massDestroy(MassDestroyCredentialRequest $request)
    {
        $credentials = Credential::find(request('ids'));

        foreach ($credentials as $credential) {
            $credential->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function verifyPassword(Request $request){
        $credential_id = $request->credential_id;
        $password = $request->password;
        $credential = Credential::find($credential_id);
        $resp = false;
        if (Hash::check($password, $credential->password)) {
            $resp = true;
        }
        return response()->json(['matched' => $resp], 200);
    }
}
