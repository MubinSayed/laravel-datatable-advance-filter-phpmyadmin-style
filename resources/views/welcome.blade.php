<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Datatable CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <title>Laravel Datatable Advance Filter (phpMyAdmin Style) </title>
</head>

<body>

    <div class="col-lg-8 mx-auto p-3 py-md-5">
        <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
            <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="me-2" viewBox="0 0 118 94"
                    role="img">
                    <title>Bootstrap</title>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"
                        fill="currentColor"></path>
                </svg>
                <span class="fs-4">Laravel Datatable Advance Filter (phpMyAdmin Style)</span>
            </a>
        </header>

        <div class="accordion" id="filter-table">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Filter
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#filter-table">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="mb-3  row">
                                    <label class="col-sm-3 col-form-label" for="course_name">Course Name</label>
                                    <div class="col-md-4">
                                        <select name="course_name_operator" id="course_name_operator"
                                            class="select2me form-control  searchOperator">
                                            {{-- Always keep "lk alias LIKE" option first --}}
                                            {{ filterOptions(["lk", "e", "ne", "n", "nn"]) }}
                                        </select>
                                    </div>

                                    <div class="col-sm-4" id="course_name_div">
                                        <input type="text" name="course_name" value=""
                                            class="form-control filterControl" id="course_name"
                                            placeholder="Course Name" required>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12">

                                <div class="mb-3  row">
                                    <label class="col-sm-3 col-form-label" for="course_code"> Course Code</label>
                                    <div class="col-md-4">
                                        <select name="course_code_operator" id="course_code_operator"
                                            class="select2me form-control  searchOperator">
                                            {{ filterOptions(["e", "ne", "n", "nn", "lk"]) }}
                                        </select>
                                    </div>

                                    <div class="col-sm-4" id="course_code_div">
                                        <input type="text" name="course_code" value=""
                                            class="form-control filterControl" id="course_code"
                                            placeholder="Course Code">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col text-center">
                                <button type="button" class="btn btn-danger filter-reset">Reset</button>
                                <button type="button" class="btn btn-success search-form">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <table class="table" id="course_table" style="width: 100%">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Code</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>



        <footer class="pt-5 my-5 text-muted border-top">
            Created with <span class="text-danger">&hearts;</span> by Mubin Sayed · 2021
        </footer>
    </div>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Datatable Js -->
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready( function () {

            var oTable = $('#course_table').DataTable({
                processing: true,
                serverSide: true,
                "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "ajax": {
                    url: '{{ route('course') }}',
                    data: function (d) {
                        d.course_name = $('input[name=course_name]').val();
                        d.course_name_operator = $('#course_name_operator').val();

                        d.course_code = $('input[name=course_code]').val();
                        d.course_code_operator = $('#course_code_operator').val();
                    }
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "code" },
                ]
            });

            /* ---------------------Filter events start------------------------ */
            // filter on button click
            $(document).on('click', '.search-form', function(e) {
                e.preventDefault();
                oTable.draw();
                console.log('search');
            });

            // reset filter
            $(document).on('click', '.filter-reset', function(e) {
                $('.searchOperator').trigger('change');
                $(".filterControl").val("");
                $('#select_filter').trigger("reset");
                oTable.draw(false);
	        });

            // filter on enter
            $(document).on('keypress', '.filterControl', function(e) {
                var code = e.keyCode || e.which;
                if (code == 13) {
                    oTable.draw();
                    e.preventDefault();
                }
            });

            // operator change event
            $(document).on('change','.searchOperator',function(){
                var input_id = $(this).attr("id");

                input_id = input_id.split("_operator");

                var input_val = $(this).val();

                if(input_val == "=''" || input_val == "!=''")
                {
                    $("#"+input_id[0]).val('');
                    $("#"+input_id[0]+"_div").hide();
                    $("#"+input_id[0]+"_range").hide();

                }
                else if(input_val == "BETWEEN" || input_val == "NOT BETWEEN")

                {
                    $("#"+input_id[0]).val('');
                    $("#"+input_id[0]+"_div").hide();
                    $("#"+input_id[0]+"_range").show();
                }
                else{
                    $("#"+input_id[0]+"_div").show();
                    $("#"+input_id[0]+"_range").hide();
                }
            });

            /* ---------------------Filter events ends------------------------ */

            // to focus on Name field (by default) on page load
            $('#course_name').focus();

        });
    </script>

</body>

</html>
