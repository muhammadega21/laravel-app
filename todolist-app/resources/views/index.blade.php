<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To Do List App</title>

    {{-- My Style --}}

    {{-- gunakan kode ini jika menggunakan NGINX --}}
    <link rel="stylesheet" href="{{ url('css/style.css?v=' . time()) }}">

    {{-- default --}}
    {{-- <link rel="stylesheet" href="{{ url('css/style.css'}}">  --}}

    {{-- CDN --}}
    <script src='https://cdn.tailwindcss.com'></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src='https://code.jquery.com/jquery-3.7.0.min.js'
        integrity='sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=' crossorigin='anonymous'></script>
</head>

<body>
    <div class="grid place-items-center p-10">
        <x-card :datas="$datas" :uncompleteDatas="$uncompleteDatas"></x-card>
    </div>

    @if (Session::has('storeTodo'))
        <script>
            swal("Success!", "{{ Session::get('storeTodo') }}", "success"), {
                button: true,
                button: 'ok'
            }
        </script>
    @elseif(Session::has('deleteTodo'))
        <script>
            swal("Success!", "{{ Session::get('deleteTodo') }}", "success"), {
                button: true,
                button: 'ok'
            }
        </script>
    @elseif(Session::has('completeTodo'))
        <script>
            swal("Success!", "{{ Session::get('completeTodo') }}", "success"), {
                button: true,
                button: 'ok'
            }
        </script>
    @elseif(Session::has('updateTodo'))
        <script>
            swal("Success!", "{{ Session::get('updateTodo') }}", "success"), {
                button: true,
                button: 'ok'
            }
        </script>
    @endif

    <script src="{{ url('js/script.js?v=') . time() }}"></script>
</body>

</html>
