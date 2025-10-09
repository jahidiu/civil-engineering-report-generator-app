<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $certificate->brtc_no . '|' . $siteData['site_name'] }}</title>
    <meta name="title" content="{{ $siteData['site_name'] }} | {{ $siteData['meta_title'] }}" />
    <meta name="description" content="{{ $siteData['meta_description'] }}" />
    <meta name="keywords" content="{{ $siteData['meta_tag'] }}" />
    <link rel="shortcut icon" href="{{ showDefaultImage('storage/' . $siteData['favicon']) }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link
        rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        .content {
            position: relative;
            z-index: 1;
            background: #fff;
            margin: 50px;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        /* @media print {
            .content {
                background: transparent;
                box-shadow: none;
                margin: 0;
                height: 100vh;
                font-family: 'Times New Roman', serif;
                background: repeating-radial-gradient(circle at center,
                        rgba(173, 216, 230, 0.4) 0px,
                        rgba(173, 216, 230, 0.4) 1px,
                        transparent 1px,
                        transparent 25px
                    );
                background-size: cover;
            }
        } */
        @media print {
            .content {
                background: transparent;
                box-shadow: none;
                margin: 0;
                height: 100vh;
                font-family: 'Times New Roman', serif;
                background: repeating-radial-gradient(circle at center,
                        rgba(173, 216, 230, 0.4) 0px,
                        rgba(173, 216, 230, 0.4) 1px,
                        transparent 1px,
                        transparent 2px);
                background-size: cover;
            }

            .no-print {
                display: none !important;
            }

            .certificate-header img {
                width: 70px;
            }
        }

        .certificate-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .certificate-header img {
            width: 80px;
            height: auto;
        }

        .certificate-header,
        .certificate-footer {
            text-align: center;
        }

        .certificate-header h5,
        .certificate-header h6 {
            margin: 0;
            font-weight: bold;
        }

        .bordered {
            border: 1px solid #000;
            border-collapse: collapse;
            background: transparent;
            width: 100%;
        }

        .bordered th,
        .bordered td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
            background: transparent;
        }

        .certificate-info td {
            background: transparent;
        }

        .certificate-info td {
            text-align: left;
            padding: 3px 0;
            border: none;
        }

        .table-note {
            margin-top: 5px;
            font-size: 14px;
            text-align: left;
        }

        .table-note .right {
            float: right;
        }

        .signature-block {
            margin-top: 40px;
            align-items: flex-start;
        }

        .signature-block p {
            margin-bottom: 2px;
            line-height: 1.1;
            font-size: 14px;
        }

        .qr-placeholder {
            width: 100px;
            height: 100px;
            border: 1px solid #000;
            padding: 4px;
            background: #f9f9f9;
        }

        .footer-note {
            font-size: 12px;
            text-align: justify;
            margin-top: 20px;
        }

        hr {
            border: 2px solid #000;
        }

        .qr-block {
            display: inline-block;
            text-align: center !important;
            padding: 5px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        .qr-top-id {
            font-size: 12px;
            margin: 0;
            color: #000;
        }

        .qr-bottom-code {
            font-size: 12px;
            font-weight: 600;
            margin-top: 2px;
            color: #000;
        }

        .qr-placeholder,
        svg[role="img"] {
            width: 120px;
            height: 120px;
        }

        .nowrap {
            white-space: nowrap !important;
        }
    </style>
</head>

<body class="content">
    <div class="d-flex justify-content-between align-items-center mb-3 no-print">
        <a href="{{ route('certificate.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>

        <button onclick="window.print()" class="btn btn-outline-success">
            <i class="bi bi-printer"></i> Print
        </button>
    </div>

    <!-- Header -->
    <div class="certificate-header d-flex align-items-center justify-content-between mb-3">
        <!-- Left Logo -->
        <div class="logo-left text-start">
            <img src="{{ showDefaultImage('storage/' . $siteData['primary_logo']) }}" alt="Left Logo" style="width: 80px; height: auto;">
        </div>

        <!-- Center Text -->
        <div class="text-center flex-grow-1">
            <h5 class="mb-1">BANGLADESH UNIVERSITY OF ENGINEERING AND TECHNOLOGY (BUET)</h5>
            <h6 class="mb-1">DEPARTMENT OF CIVIL ENGINEERING</h6>
            <p class="mb-1">
                Mobile: 01819557964, PABX: 55660000-2 Ext 7226 <br>
                <a href="http://brtctest.ce.buet.ac.bd" target="_blank">brtctest.ce.buet.ac.bd</a> |
                <a href="https://verify.ce.buet.ac.bd" target="_blank">verify.ce.buet.ac.bd</a>
            </p>
            <p class="fw-bold mb-0">CONCRETE LABORATORY</p>
        </div>

        <!-- Right Logo -->
        <div class="logo-right text-end">
            <img src="{{ showDefaultImage('storage/' . $siteData['secondary_logo']) }}" alt="Right Logo" style="width: 80px; height: auto;">
        </div>
    </div>

    <hr>

    <!-- Certificate Info -->
    <table class="table certificate-info">
        <tr>
            <td class="nowrap"><b>BRTC No.</b></td>
            <td>:&nbsp;</td>
            <td colspan="2"><b>{{ $certificate->brtc_no }}; Dt: {{ $certificate->brtc_date ? \Carbon\Carbon::parse($certificate->brtc_date)->format('d/m/Y') : '—' }}</b></td>

        </tr>
        <tr>
            <td><b>Sent by</b></td>
            <td>:&nbsp;</td>
            <td colspan="2">{{ $certificate->sent_by }}</td>
        </tr>
        <tr>
            <td><b>Ref. No.</b></td>
            <td>:&nbsp;</td>
            <td colspan="2">{{ $certificate->ref_no }}; Dt: {{ $certificate->ref_date ? \Carbon\Carbon::parse($certificate->ref_date)->format('d/m/Y') : '—' }}</td>

        </tr>
        <tr>
            <td><b>Project</b></td>
            <td>:&nbsp;</td>
            <td colspan="2">{{ $certificate->project }}</td>
        </tr>
        <tr>
            <td><b>Sample</b></td>
            <td>:&nbsp;</td>
            <td style="width: 30%"><b>{{ $certificate->sample }}</b></td>
            <td> {!! $certificate->sample_note !!}</td>
        </tr>
        <tr>
            <td><b>Location</b></td>
            <td>:&nbsp;</td>
            <td colspan="2">{{ $certificate->location }}</td>
        </tr>
        <tr>
            <td><b>Test</b></td>
            <td>:&nbsp;</td>
            <td colspan="2"><b>{{ $certificate->test_name }}</b></td>
        </tr>
        <tr>
            <td class="nowrap"><b>Date of Test&nbsp; </b></td>
            <td>:&nbsp;</td>
            <td colspan="2">{{ $certificate->date_of_test ? \Carbon\Carbon::parse($certificate->date_of_test)->format('d/m/Y') : '—' }}</td>
        </tr>
    </table>

    <hr>

    <!-- Certificate Title -->
    <h6 class="text-center"><b>TEST REPORT</b></h6>

    <!-- Test Results Table -->
    <table class="table bordered">
        <thead>
            <tr>
                <th>Sl. No.</th>
                <th>Date of <br>Casting as <br>per the letter</th>
                <th>Specimen <br>Designation/<br>Forg Mark</th>
                <th>Specimen <br>Area</th>
                <th>Maximum <br>Load</th>
                <th>Crushing <br>Strength</th>
                <th>Average <br>Crushing<br> Strength</th>
                <th>Mode of <br>Failure</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th>(sq. in)</th>
                <th>(lb)</th>
                <th>(psi)</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            @forelse ($certificate->testResults as $index => $result)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $result->date_of_casting ? \Carbon\Carbon::parse($result->date_of_casting)->format('d/m/Y') : '—' }} <br> <b>({{ $certificate->total_day_of_test }}
                            days test)</b></td>
                    <td>{{ $result->specimen_designation ?? '—' }}</td>
                    <td>{{ number_format($result->specimen_area, 2) ?? '—' }}</td>
                    <td>{{ number_format($result->maximum_load, 0) ?? '—' }}</td>
                    <td>{{ number_format($result->crushing_strength, 0) ?? '—' }}</td>
                    <td>{{ $result->average_strength ? number_format($result->average_strength, 0) : '—' }}</td>
                    <td>{{ $result->mode_of_failure ?? '—' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No test results available</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Table Note (outside table) -->
    <div class="table-note clearfix">
        <span><b>Note:</b> {{ $certificate->notes }}</span>
        <span class="right">*Combined = Mortar and Aggregate Failure</span>
    </div>

    <!-- Signatures -->
    <div class="row signature-block">
        <!-- Left Signatory -->
        <div class="col-4 text-start">
            <p style="margin-bottom: 80px">{{ $certificate->leftSignatory->role }} by:</p>
            <p><b>{{ $certificate->leftSignatory->name }}</b></p>
            <p>{{ $certificate->leftSignatory->designation }}</p>
            <p>{{ $certificate->leftSignatory->department }}</p>
            <p><i>{{ $certificate->leftSignatory->institute }}</i></p>
        </div>

        <!-- Middle QR Code -->
        <div class="col-4 text-center">
            @if (!empty($certificate->qr_code_id))
                @php
                    $baseUrl = preg_replace('#^https?://#', '', rtrim(config('app.url'), '/'));
                    $QrCodeUrl = 'verify.ac.' . $baseUrl . '/' . $certificate->qr_code_id;
                @endphp
                <div class="qr-block">
                    <p class="qr-top-id">{{ $certificate->qr_sl }}</p>
                    {!! QrCode::size(120)->margin(0)->color(0, 0, 0)->backgroundColor(255, 255, 255)->generate($QrCodeUrl) !!}
                    <p class="qr-bottom-code">{{ $certificate->qr_code_id }}</p>
                </div>
            @else
                <img src="https://placehold.co/100x100?text=No+QR" alt="QR Code" class="qr-placeholder">
            @endif
        </div>

        <!-- Right Signatory -->
        <div class="col-4 text-start">
            <p style="margin-bottom: 80px">{{ $certificate->rightSignatory->role }} by:
            <img src="{{ showDefaultImage('storage/' . $siteData['seal']) }}" alt="Left Logo" style="width: 80px; height: auto; padding-left:30px;"></p>
            <p class="text-end">{{ \Carbon\Carbon::parse($certificate->signature_date)->format('d/m/Y') }}</p>
            <p><b>{{ $certificate->rightSignatory->name }}</b></p>
            <p>{{ $certificate->rightSignatory->designation }}</p>
            <p>{{ $certificate->rightSignatory->department }}</p>
            <p><i>{{ $certificate->rightSignatory->institute }}</i></p>
        </div>
    </div>

    <hr>

    <!-- Footer -->
    <div class="footer-note">
        <p>
            <b>Important Notes:</b> Samples as supplied to us have been tested in our laboratory.
            BRTC does not have any responsibility as to the representative character of the samples
            required to be tested. It is recommended that samples are sent in a secure and sealed
            wrapper/container under signature of the competent authority, in order to avoid fraudulent
            fabrication of test results. It is recommended that all test certificates are collected by duly
            authorized person, and not by the Contractor/Supplier.
        </p>
        {{-- <p class="text-center">Page 1 of 2 | BRTC BUET | BUETCE 0562309</p> --}}
    </div>

</body>

</html>
