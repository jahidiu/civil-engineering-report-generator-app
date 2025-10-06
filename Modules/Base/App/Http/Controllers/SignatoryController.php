<?php

namespace Modules\Base\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\RedirectResponse;
use Modules\Base\App\Repository\Eloquents\SignatoryRepository;

class SignatoryController extends Controller
{
    public function __construct(private SignatoryRepository $repository) {}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->repository->allDataTable();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('backend.includes.action', [
                        'routeEdit'   => route('signatory.edit', $row->id),
                        'routeDelete' => route('signatory.delete', $row->id),
                        'id'          => $row->id,
                        'title'       => 'Signatory',
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('base::signatory.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('base::signatory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'designation'  => 'required|string|max:255',
            'department'   => 'nullable|string|max:255',
            'institute'    => 'nullable|string|max:255',
            'role'         => 'nullable|string|max:255',
        ]);

        try {
            $this->repository->create($validated);
            return redirect()->route('signatory.index')->with('success', 'Signatory created successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $signatory = $this->repository->findById($id);
    //     return view('base::signatory.show', compact('signatory'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $signatory = $this->repository->findById($id);
        return view('base::signatory.edit', compact('signatory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'designation'  => 'required|string|max:255',
            'department'   => 'nullable|string|max:255',
            'institute'    => 'nullable|string|max:255',
            'role'         => 'nullable|string|max:255',
        ]);

        try {
            $signatory = $this->repository->findById($id);
            $signatory->update($validated);

            return redirect()->route('signatory.index')->with('success', 'Signatory updated successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $signatory = $this->repository->findById($request->id);
            $signatory->delete();
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    /**
     * Get page list
     */
    public function get_for_select(Request $request)
    {
        $data = $this->repository->getServerSideDataForSelectOption($request->search, [], ['name','designation','role'], 'id', 'name', '10');
        return response()->json($data);
    }
}
