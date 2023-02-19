
<div class="card text-bg-light mb-3">
    <div class="card-header">Result</div>
    <div class="card-body">
        <table class="table table-light table-hover">
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Open</th>
                <th scope="col">High</th>
                <th scope="col">Low</th>
                <th scope="col">Close</th>
                <th scope="col">Volume</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $history)
            <tr>
                <td>
                    {{ date('Y-m-d', $history['date']) }}
                </td>
                <td>
                    {{ $history['open'] }}
                </td>
                <td>
                    {{ $history['high'] }}
                </td>
                <td>
                    {{ $history['low'] }}
                </td>
                <td>
                    {{ $history['close'] }}
                </td>
                <td>
                    {{ $history['volume'] }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
</div>
