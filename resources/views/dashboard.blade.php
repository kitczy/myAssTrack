@extends('layouts.sidebar')

@section('page-title', 'Dashboard')

@section('content')

<style>

.stat-card {
    background: #fff;
    border: 1px solid #e9ecef;
    border-radius: 16px;
    padding: 24px 22px;
    display: flex;
    align-items: center;
    gap: 16px;
    transition: all .2s ease;
}

.stat-card:hover {
    border-color: #b5d4f4;
}

.clickable-card{
    cursor:pointer;
}

.clickable-card:hover{
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(13,110,253,.10);
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}

.stat-icon.blue  { background: #E6F1FB; color: #185FA5; }
.stat-icon.green { background: #eaf3de; color: #3b6d11; }
.stat-icon.amber { background: #faeeda; color: #854f0b; }

.stat-label {
    font-size: 12px;
    color: #adb5bd;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .05em;
    margin-bottom: 4px;
}

.stat-value {
    font-size: 28px;
    font-weight: 800;
    color: #0d1b2a;
    line-height: 1;
}

.section-card {
    background: #fff;
    border: 1px solid #e9ecef;
    border-radius: 16px;
    padding: 22px;
}

.section-card-title {
    font-size: 15px;
    font-weight: 800;
    color: #0d1b2a;
    margin: 0 0 4px;
}

.section-card-sub {
    font-size: 12px;
    color: #adb5bd;
    margin-bottom: 18px;
}

/* Task item */
.task-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 12px 14px;
    border-radius: 12px;
    border: 1px solid #e9ecef;
    background: #fdfdfd;
    margin-bottom: 8px;
    transition: border-color .15s;
}

.task-item:last-child {
    margin-bottom: 0;
}

.task-item:hover {
    border-color: #b5d4f4;
}

.task-dot {
    width: 9px;
    height: 9px;
    border-radius: 50%;
    flex-shrink: 0;
}

.task-dot.due    { background: #854f0b; }
.task-dot.urgent { background: #dc3545; }
.task-dot.done   { background: #3b6d11; }
.task-dot.normal { background: #185FA5; }

.task-name {
    font-size: 14px;
    font-weight: 600;
    color: #0d1b2a;
    margin-bottom: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 260px;
}

.task-meta {
    font-size: 12px;
    color: #adb5bd;
}

.task-badge {
    margin-left: auto;
    font-size: 11px;
    font-weight: 600;
    padding: 4px 11px;
    border-radius: 99px;
    white-space: nowrap;
    flex-shrink: 0;
}

.task-badge.due    { background: #faeeda; color: #854f0b; }
.task-badge.urgent { background: #fff0f0; color: #dc3545; }
.task-badge.done   { background: #eaf3de; color: #3b6d11; }
.task-badge.normal { background: #E6F1FB; color: #185FA5; }

.empty-state {
    text-align: center;
    padding: 32px 0;
    color: #adb5bd;
    font-size: 14px;
}

.empty-state i {
    font-size: 32px;
    margin-bottom: 10px;
    display: block;
    color: #dee2e6;
}

.chart-card {
    background: #fff;
    border: 1px solid #e9ecef;
    border-radius: 16px;
    padding: 24px;
}

.chart-header {
    margin-bottom: 24px;
}

.chart-title {
    font-size: 15px;
    font-weight: 800;
    color: #0d1b2a;
    margin: 0 0 2px;
}

.chart-sub {
    font-size: 12px;
    color: #adb5bd;
}

</style>

<div class="row g-3 mb-4">

    <!-- Total users -->
    <div class="col-md-4">
        <a href="{{ route('users') }}"
           class="text-decoration-none">
            <div class="stat-card clickable-card">
                <div class="stat-icon blue">
                    <i class="fa-solid fa-users"></i>
                </div>

                <div>
                    <div class="stat-label">Total Users</div>
                    <div class="stat-value">{{ $userCount ?? 0 }}</div>
                </div>
            </div>
        </a>
    </div>

    <!-- My task -->
    <div class="col-md-4">
        <a href="{{ route('assignments') }}"
           class="text-decoration-none">
            <div class="stat-card clickable-card">
                <div class="stat-icon green">
                    <i class="fa-solid fa-book-open"></i>
                </div>
                <div>
                    <div class="stat-label">My Assignments This Week</div>
                    <div class="stat-value">{{ $myTaskCount ?? 0 }}</div>
                </div>
            </div>
        </a>
    </div>

    <!-- Total task -->
    <div class="col-md-4">
        <a href="{{ route('assignments') }}"
           class="text-decoration-none">
            <div class="stat-card clickable-card">
                <div class="stat-icon amber">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <div>
                    <div class="stat-label">Total Assignments</div>
                    <div class="stat-value">{{ $taskCount ?? 0 }}</div>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Tasks + chart -->
<div class="row g-3 mb-4">
    <!-- Tasks -->
    <div class="col-md-5">
        <div class="section-card h-100">
            <p class="section-card-title">
                Assignments This Week
            </p>
            <p class="section-card-sub">
                {{ now()->startOfWeek()->format('M j') }}
                —
                {{ now()->endOfWeek()->format('M j, Y') }}
            </p>

            @if(isset($tasks) && $tasks->count())
                @foreach($tasks as $task)
                    @php
                        $due  = \Carbon\Carbon::parse($task->due_date);
                        $now  = now();
                        $diff = $now->diffInHours($due, false);
                        if ($task->status === 'done' || $task->status === 'completed') {
                            $type  = 'done';
                            $label = 'Done';
                        } elseif ($diff < 0) {
                            $type  = 'urgent';
                            $label = 'Overdue';
                        } elseif ($diff <= 3) {
                            $type  = 'urgent';
                            $label = 'Urgent';
                        } elseif ($diff <= 24) {
                            $type  = 'due';
                            $label = 'Due Soon';
                        } else {
                            $type  = 'normal';
                            $label = 'On Track';
                        }
                    @endphp

                    <div class="task-item">
                        <div class="task-dot {{ $type }}"></div>
                        <div style="min-width:0; flex:1;">
                            <div class="task-name">
                                {{ $task->title }}
                            </div>
                            <div class="task-meta">
                                Due {{ $due->format('M j, Y') }}
                            </div>
                        </div>
                        <span class="task-badge {{ $type }}">
                            {{ $label }}
                        </span>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <i class="fa-regular fa-calendar-check"></i>
                    No assignments this week. Nice!
                </div>
            @endif
        </div>
    </div>

    <!-- Chart -->
    <div class="col-md-7">
        <div class="chart-card h-100">
            <div class="chart-header">
                <p class="chart-title">
                    Overview
                </p>
                <p class="chart-sub">
                    A quick look at your current numbers
                </p>
            </div>
            <div style="height:260px;">
                <canvas id="dashboardChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const chartElement = document.getElementById('dashboardChart');
if (chartElement) {
    new Chart(chartElement, {
        type: 'bar',
        data: {
            labels: [
                'Total Users',
                'My Assignments This Week',
                'Total Assignments'
            ],
            datasets: [{
                label: 'Count',
                data: [
                    {{ $userCount ?? 0 }},
                    {{ $myTaskCount ?? 0 }},
                    {{ $taskCount ?? 0 }}
                ],
                backgroundColor: [
                    '#E6F1FB',
                    '#eaf3de',
                    '#faeeda'
                ],
                borderColor: [
                    '#185FA5',
                    '#3b6d11',
                    '#854f0b'
                ],
                borderWidth: 1.5,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12,
                            family: 'Arial'
                        },
                        color: '#adb5bd'
                    },
                    border: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f4f6f9'
                    },
                    ticks: {
                        font: {
                            size: 12,
                            family: 'Arial'
                        },
                        color: '#adb5bd',
                        stepSize: 1
                    },
                    border: {
                        display: false
                    }
                }
            }
        }
    });
}

</script>

@endsection