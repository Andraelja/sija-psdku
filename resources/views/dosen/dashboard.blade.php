@extends('dosen/layouts.template')

@section('title', 'Dashboard - Dosen - SIJA-PSDKU')

@section('content')
    <main id="main" class="main">
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @endif

        <div class="pagetitle">
            <h1>Dashboard Dosen</h1>
            <p>Selamat datang, <strong>{{ $dosen->nama }}</strong>!</p>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Kalender Akademik</h5>
                <div id="calendar"></div>
            </div>
        </div>
    </main><!-- End #main -->

    @section('scripts')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

        <style>
            .pagetitle {
                margin-bottom: 20px;
            }

            .card {
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                border-radius: 10px;
            }

            .card-body {
                padding: 20px;
            }

            #calendar {
                max-width: 100%;
                margin: 0 auto;
                padding: 10px;
                border-radius: 10px;
            }

            /* Ukuran petak kalender */
            .fc-daygrid-day {
                min-height: 100px; /* Tinggi petak kalender */
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    height: 600, // Tinggi kalender yang lebih proporsional
                    expandRows: true, // Membuat petak kalender tidak terlalu kecil
                    locale: 'id' // Setting bahasa Indonesia
                });
                calendar.render();
            });
        </script>
    @endsection
@endsection
