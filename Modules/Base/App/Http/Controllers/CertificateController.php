<?php

namespace Modules\Base\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Base\App\Repository\Eloquents\CertificateRepository;
use Yajra\DataTables\Facades\DataTables;


class CertificateController extends Controller
{
    public function __construct(private CertificateRepository $repository) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->repository->allDataTable();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('date_of_test', function ($row) {
                    return $row->date_of_test ? showDateFormat($row->date_of_test) : '-';
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at ? showDateFormat($row->created_at) : '-';
                })
                ->addColumn('action', function ($row) {
                    return view('backend.includes.action', [
                        'routeEdit'   => route('certificate.edit', $row->id),
                        'routeShow'   => route('certificate.show', $row->id),
                        'routeDelete' => route('certificate.delete'),
                        'id'          => $row->id,
                        'title'       => 'Certificate'
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('base::certificate.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('base::certificate.create');
    }

    /**
     * Store a newly created certificate with test results.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'left_signatory_id'  => 'nullable|integer',
            'right_signatory_id' => 'nullable|integer',
            'signature_date'     => 'nullable|date',
            'qr_sl'             => 'nullable|integer',
            'qr_code_id'      => 'nullable|string|max:20',
            'brtc_no'         => 'nullable|string|max:255',
            'brtc_date'       => 'nullable|date',
            'ref_no'          => 'nullable|string|max:255',
            'ref_date'        => 'nullable|date',
            'sent_by'         => 'nullable|string|max:255',
            'sample'          => 'nullable|string',
            'sample_note'     => 'nullable|string',
            'project'         => 'nullable|string|max:255',
            'location'        => 'nullable|string|max:255',
            'test_name'       => 'nullable|string|max:255',
            'date_of_test'    => 'nullable|date',
            'notes'           => 'nullable|string',
            'total_day_of_test' => 'nullable|integer',
            'test_results'    => 'nullable|array',
            'test_results.*.date_of_casting'      => 'nullable|date',
            'test_results.*.specimen_designation' => 'nullable|string|max:50',
            'test_results.*.specimen_area'        => 'nullable|numeric',
            'test_results.*.maximum_load'         => 'nullable|numeric',
            'test_results.*.crushing_strength'    => 'nullable|numeric',
            'test_results.*.average_strength'     => 'nullable|numeric',
            'test_results.*.mode_of_failure'      => 'nullable|string|max:100',
        ]);

        DB::beginTransaction();
        try {
            $certificate = $this->repository->create($validated);

            if ($request->filled('test_results')) {
                foreach ($request->test_results as $result) {
                    $certificate->testResults()->create($result);
                }
            }

            DB::commit();
            return redirect()->route('certificate.index')->with('success', 'Certificate created successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display a specific certificate.
     */
    public function show($id)
    {
        $data['certificate'] = $this->repository->findById($id, ['*'], ['testResults', 'leftSignatory', 'rightSignatory']);
        return view('base::certificate.show', $data);
    }

    /**
     * Show the form for editing a certificate.
     */
    public function edit($id)
    {
        $data['certificate'] = $this->repository->findById($id, ['*'], ['testResults']);
        return view('base::certificate.edit', $data);
    }

    /**
     * Update the specified certificate and its test results.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'left_signatory_id'  => 'nullable|integer',
            'right_signatory_id' => 'nullable|integer',
            'signature_date'     => 'nullable|date',
            'qr_sl'             => 'nullable|integer',
            'qr_code_id'      => 'nullable|string|max:20',
            'brtc_no'         => 'nullable|string|max:255',
            'brtc_date'       => 'nullable|date',
            'ref_no'          => 'nullable|string|max:255',
            'ref_date'        => 'nullable|date',
            'sent_by'         => 'nullable|string|max:255',
            'sample'          => 'nullable|string',
            'sample_note'     => 'nullable|string',
            'project'         => 'nullable|string|max:255',
            'location'        => 'nullable|string|max:255',
            'test_name'       => 'nullable|string|max:255',
            'date_of_test'    => 'nullable|date',
            'notes'           => 'nullable|string',
            'total_day_of_test' => 'nullable|integer',
            'test_results'    => 'nullable|array',
        ]);

        DB::beginTransaction();
        try {
            $certificate = $this->repository->findById($id);
            $certificate->update($validated);

            // Delete old results then reinsert new ones
            $certificate->testResults()->delete();
            if ($request->filled('test_results')) {
                foreach ($request->test_results as $result) {
                    $certificate->testResults()->create($result);
                }
            }

            DB::commit();
            return redirect()->route('certificate.index')->with('success', 'Certificate updated successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove a certificate and its related test results.
     */
    public function destroy(Request $request)
    {
        try {
            $certificate = $this->repository->findById($request->id);
            $certificate->testResults()->delete();
            $certificate->delete();

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
