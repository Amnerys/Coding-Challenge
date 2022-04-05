<table>
    <tr>
        <th>Row Title</th>

        <th>Data 1</th>
        <th>Data 2</th>
        <th>Data 3</th>
    </tr>
    @foreach ($data as $line)
        <tr>
            <td>{{ $data[0] }}</td>

            @foreach ($row as $col)
                <td>{{ $col }}</td>
            @endforeach
        </tr>
    @endforeach
</table>
