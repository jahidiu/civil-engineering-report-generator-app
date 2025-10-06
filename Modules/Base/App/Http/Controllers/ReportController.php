<?php

namespace Modules\Base\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Base\App\Repository\Eloquents\ReportRepository;
use Yajra\DataTables\Facades\DataTables;


class ReportController extends Controller
{
    public function __construct(private ReportRepository $repository) {}

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
                        'routeEdit'   => route('report.edit', $row->id),
                        'routeShow'   => route('report.show', $row->id),
                        'routeDelete' => route('report.delete'),
                        'id'          => $row->id,
                        'title'       => 'Report'
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('base::report.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('base::report.create');
    }

    /**
     * Store a newly created report with test results.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'left_signatory_id'  => 'nullable|integer',
            'right_signatory_id' => 'nullable|integer',
            'qr_code_id'      => 'nullable|string|max:20',
            'brtc_no'         => 'nullable|string|max:255',
            'brtc_date'       => 'nullable|date',
            'ref_no'          => 'nullable|string|max:255',
            'ref_date'        => 'nullable|date',
            'sent_by'         => 'nullable|string|max:255',
            'sample'          => 'nullable|string',
            'project'         => 'nullable|string|max:255',
            'location'        => 'nullable|string|max:255',
            'test_name'       => 'nullable|string|max:255',
            'date_of_test'    => 'nullable|date',
            'notes'           => 'nullable|string',
            'page_ref'        => 'nullable|string|max:50',
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
            $report = $this->repository->create($validated);

            if ($request->filled('test_results')) {
                foreach ($request->test_results as $result) {
                    $report->testResults()->create($result);
                }
            }

            DB::commit();
            return redirect()->route('report.index')->with('success', 'Report created successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display a specific report.
     */
    public function show($id)
    {
        $data['report'] = $this->repository->findById($id, ['*'], ['testResults', 'leftSignatory', 'rightSignatory']);
        return view('base::report.show', $data);
    }

    /**
     * Show the form for editing a report.
     */
    public function edit($id)
    {
        $data['report'] = $this->repository->findById($id, ['*'], ['testResults']);
        return view('base::report.edit', $data);
    }

    /**
     * Update the specified report and its test results.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'left_signatory_id'  => 'nullable|integer',
            'right_signatory_id' => 'nullable|integer',
            'qr_code_id'      => 'nullable|string|max:20',
            'brtc_no'         => 'nullable|string|max:255',
            'brtc_date'       => 'nullable|date',
            'ref_no'          => 'nullable|string|max:255',
            'ref_date'        => 'nullable|date',
            'sent_by'         => 'nullable|string|max:255',
            'sample'          => 'nullable|string',
            'project'         => 'nullable|string|max:255',
            'location'        => 'nullable|string|max:255',
            'test_name'       => 'nullable|string|max:255',
            'date_of_test'    => 'nullable|date',
            'notes'           => 'nullable|string',
            'page_ref'        => 'nullable|string|max:50',
            'test_results'    => 'nullable|array',
        ]);

        DB::beginTransaction();
        try {
            $report = $this->repository->findById($id);
            $report->update($validated);

            // Delete old results then reinsert new ones
            $report->testResults()->delete();
            if ($request->filled('test_results')) {
                foreach ($request->test_results as $result) {
                    $report->testResults()->create($result);
                }
            }

            DB::commit();
            return redirect()->route('report.index')->with('success', 'Report updated successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove a report and its related test results.
     */
    public function destroy(Request $request)
    {
        try {
            $report = $this->repository->findById($request->id);
            $report->testResults()->delete();
            $report->delete();

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
