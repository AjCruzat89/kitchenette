@include('component.adminheader')
<div class="d-flex flex-row w-100">
    @include('component.adminsidebar')
    <div class="d-flex flex-grow-1 flex-column" id="main">
        @include('component.adminnavbar')
        <div class="d-flex flex-column px-3 py-3" id="mainContent">
            <h1>Activity Log</h1>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Activity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activityLogs as $activityLog)
                            <tr>
                                <td>{{ $activityLog->name }}</td>
                                <td>{{ $activityLog->activity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-start">
                {{ $activityLogs->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
    <script>
        document.title = 'Kitchenette | Activity'
    </script>
    @include('component.adminfooter')
