<?php
if(Auth::check()){
    $username = Auth::user()->username;
    $img = Auth::user()->img;
    $userId = Auth::id();
    $admin = Auth::user()->is_admin;
}
?>
@extends('layouts.layout')
@section("title","Admin")
@section('content')

        <!-- Main Body -->
        <div class="container-floid d-flex align-items-center justify-content-center bg-white-gray m-0"  style="height: 83vh;">
            @if(!$admin)
                <div class="d-flex align-items-center justify-content-center w-75 h-100 text-danger bg-white-gray text-center shadow">
                    <h1>You Do not Have Access</h1>
                </div>                
            @else
            <div class="Hellow"></div>
            <div id="postPart" class="w-75 h-100 bg-gray-white text-center shadow" style="height: 100vh;">
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>email</th>
                            <th>image</th>
                            <th>gender</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($users)
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user['username'] }} </td>
                            <td>{{ $user['email'] }} </td>
                            <td>{{ $user['img'] }}</td>
                            <td>{{ $user['gender'] }}</td>
                    @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>email</th>
                            <th>image</th>
                            <th>gender</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @endif
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
        <script>
$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#example thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#example thead');
 
    var table = $('#example').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                        })
                        .on('keyup', function (e) {
                            e.stopPropagation();
 
                            $(this).trigger('change');
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
    });
});
        </script>
@endsection