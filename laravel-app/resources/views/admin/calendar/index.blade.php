<x-admin-layout>

<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">

<style>
    /* ---- FullCalendar theme overrides to match admin design ---- */
    .fc { font-family: 'Lato', sans-serif; }

    .fc .fc-toolbar-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
    }

    .fc .fc-button {
        background-color: #ffffff !important;
        border: 1px solid #fde68a !important;
        color: #92400e !important;
        font-size: 0.75rem !important;
        font-weight: 600 !important;
        border-radius: 9999px !important;
        padding: 0.35rem 0.85rem !important;
        box-shadow: none !important;
        text-transform: capitalize !important;
    }
    .fc .fc-button:hover {
        background-color: #fffbeb !important;
        border-color: #f59e0b !important;
    }
    .fc .fc-button-active,
    .fc .fc-button-primary:not(:disabled).fc-button-active {
        background-color: #d97706 !important;
        border-color: #b45309 !important;
        color: #ffffff !important;
    }
    .fc .fc-button-group .fc-button { border-radius: 9999px !important; }

    .fc-theme-standard td, .fc-theme-standard th { border-color: #fef3c7; }
    .fc-theme-standard .fc-scrollgrid { border-color: #fef3c7; }

    .fc .fc-col-header-cell-cushion {
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #9ca3af;
        padding: 10px 4px;
        text-decoration: none;
    }

    .fc .fc-daygrid-day-number {
        font-size: 0.8rem;
        font-weight: 600;
        color: #6b7280;
        text-decoration: none;
        padding: 6px 8px;
    }
    .fc .fc-day-today { background-color: #fffbeb !important; }
    .fc .fc-day-today .fc-daygrid-day-number { color: #d97706; font-weight: 700; }

    .fc .fc-daygrid-event {
        border-radius: 6px;
        font-size: 0.72rem;
        font-weight: 600;
        padding: 2px 6px;
        margin: 1px 2px;
        cursor: pointer;
    }

    .fc .fc-timegrid-event {
        border-radius: 6px;
        font-size: 0.72rem;
        font-weight: 600;
    }

    .fc .fc-list-event-title a { text-decoration: none; color: inherit; }
    .fc .fc-list-empty { color: #9ca3af; font-style: italic; }

    /* Event detail popover */
    #eventPopover {
        display: none;
        position: fixed;
        z-index: 9999;
        background: white;
        border: 1px solid #fde68a;
        border-radius: 16px;
        padding: 16px;
        width: 240px;
        box-shadow: 0 10px 30px -5px rgba(0,0,0,0.15);
        pointer-events: auto;
    }
</style>

<!-- Page Header -->
<div class="mb-6 flex items-start justify-between">
    <div>
        <h1 class="text-3xl font-cabinet font-semibold text-gray-800">Calendar</h1>
        <p class="text-sm text-gray-400 mt-1">All sanctuary events on one view</p>
    </div>
    <a href="{{ route('admin.events.create') }}"
       class="flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#C9A84C] text-white text-sm font-semibold hover:bg-[#b8963e] transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
        </svg>
        New Event
    </a>
</div>

<!-- Legend -->
<div class="flex items-center gap-5 mb-4">
    <span class="flex items-center gap-1.5 text-xs font-semibold text-gray-500">
        <span class="w-3 h-3 rounded-full bg-[#FAF8F0]0 inline-block"></span> Upcoming
    </span>
    <span class="flex items-center gap-1.5 text-xs font-semibold text-gray-500">
        <span class="w-3 h-3 rounded-full bg-teal-500 inline-block"></span> Completed
    </span>
    <span class="flex items-center gap-1.5 text-xs font-semibold text-gray-500">
        <span class="w-3 h-3 rounded-full bg-red-500 inline-block"></span> Cancelled
    </span>
</div>

<!-- Calendar card -->
<div class="bg-white rounded-2xl shadow-sm border border-[#E8E2D8] p-6">
    <div id="calendar"></div>
</div>

<!-- Event detail popover -->
<div id="eventPopover">
    <div class="flex items-start justify-between mb-2">
        <p id="popTitle" class="text-sm font-bold text-gray-800 leading-snug pr-2"></p>
        <button onclick="closePopover()" class="text-gray-400 hover:text-gray-600 flex-shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    <p id="popDate"     class="text-xs text-[#C9A84C] font-semibold mb-1"></p>
    <p id="popLocation" class="text-xs text-gray-500 mb-1"></p>
    <p id="popDesc"     class="text-xs text-gray-400 mb-3 line-clamp-2"></p>
    <div class="flex gap-2">
        <a id="popEdit" href="#"
           class="flex-1 text-center text-xs font-semibold px-3 py-1.5 rounded-full bg-[#C9A84C] text-white hover:bg-[#b8963e] transition">
            Edit
        </a>
        <span id="popStatus" class="flex-1 text-center text-xs font-semibold px-3 py-1.5 rounded-full bg-[#FAF8F0] text-[#C9A84C]"></span>
    </div>
</div>

<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const calEl   = document.getElementById('calendar');
    const popover = document.getElementById('eventPopover');

    const calendar = new FullCalendar.Calendar(calEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left:   'prev,next today',
            center: 'title',
            right:  'dayGridMonth,timeGridWeek,timeGridDay,listMonth',
        },
        buttonText: {
            today:     'Today',
            month:     'Month',
            week:      'Week',
            day:       'Day',
            list:      'List',
        },
        height:      'auto',
        firstDay:    1,
        nowIndicator: true,
        selectable:  true,
        events:      '{{ route("admin.calendar.events") }}',

        // Click empty date → open create form with pre-filled date
        dateClick: function (info) {
            const d = info.dateStr.slice(0, 16) || info.dateStr + 'T00:00';
            window.location.href = '{{ route("admin.events.create") }}?date=' + encodeURIComponent(d);
        },

        // Click event → show popover
        eventClick: function (info) {
            info.jsEvent.preventDefault();
            const p = info.event.extendedProps;
            const s = info.event.start;

            document.getElementById('popTitle').textContent    = info.event.title;
            document.getElementById('popDate').textContent     = s ? s.toLocaleDateString('en-MY', { weekday:'short', year:'numeric', month:'short', day:'numeric', hour:'2-digit', minute:'2-digit' }) : '';
            document.getElementById('popLocation').textContent = p.location ? '📍 ' + p.location : '';
            document.getElementById('popDesc').textContent     = p.description || '';
            document.getElementById('popStatus').textContent   = p.status;
            document.getElementById('popEdit').href            = info.event.url;

            // Position near click
            const x = info.jsEvent.clientX;
            const y = info.jsEvent.clientY;
            const vw = window.innerWidth;
            const vh = window.innerHeight;
            popover.style.left = (x + 250 > vw ? x - 255 : x + 10) + 'px';
            popover.style.top  = (y + 200 > vh ? y - 210 : y + 10) + 'px';
            popover.style.display = 'block';
        },

        eventMouseEnter: function (info) {
            info.el.style.opacity = '0.85';
        },
        eventMouseLeave: function (info) {
            info.el.style.opacity = '1';
        },
    });

    calendar.render();

    // Close popover on outside click
    document.addEventListener('click', function (e) {
        if (!popover.contains(e.target) && !e.target.closest('.fc-event')) {
            popover.style.display = 'none';
        }
    });
});

function closePopover() {
    document.getElementById('eventPopover').style.display = 'none';
}
</script>

@if(request('date'))
<script>
    // Pre-fill date on create form if redirected from calendar click
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.querySelector('input[name="event_date"]');
        if (input) input.value = '{{ request("date") }}';
    });
</script>
@endif

</x-admin-layout>
