@include('component.adminheader')
<div class="d-flex flex-row w-100">
    @include('component.adminsidebar')
    <div class="d-flex flex-grow-1 flex-column" id="main">
        @include('component.adminnavbar')
        <div class="d-flex flex-column px-3 py-3" id="mainContent">
            <h1>Activity Log</h1>
            <div class="d-flex justify-content-start">
                <button onclick="printData()"><span class="material-symbols-outlined">
                    print
                    </span>Print</button>
            </div> 
            <div class="table-responsive mt-3">
                <table class="table table-hover" id="printTable" border="1" cellpadding="10" style="border-collapse: collapse;">
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

        function printData() {
        var divToPrint = document.getElementById("printTable");
        var newWin = window.open("");
        newWin.document.write('<html><head><title>Print Table</title></head><body>');
        newWin.document.write('<img style="display: block; margin: 50px auto; width: 180px; height: 150px; filter: drop-shadow(4px 4px 4px black);" src="./img/castiels.png">');
        newWin.document.write(divToPrint.outerHTML);
        newWin.document.write('</body></html>');
        newWin.document.close();

        newWin.onload = function() {
            newWin.print();
            newWin.close();
        };
    }
    </script>
    @include('component.adminfooter')
