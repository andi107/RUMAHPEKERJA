<x-adm-base-layout>
    <x-slot name="titleSlot">
        <title>RPH Admin - Kategori</title>
    </x-slot>

    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

    <table id="myTable">
        <tr class="header">
            <th style="width:60%;">Name</th>
            <th style="width:40%;">Country</th>
        </tr>
        
        @foreach (range(1029, 1050) as $number)
        <tr>
            <td>{{ $number }}</td>
            <td>Germany</td>
        </tr>
        @endforeach
    </table>

    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

    </script>
</x-adm-base-layout>
